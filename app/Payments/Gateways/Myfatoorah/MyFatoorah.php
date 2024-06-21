<?php

namespace App\Payments\Gateways\MyFatoorah;

use App\Payments\Gateways\GatewayInterface;
use App\Payments\Gateways\MyFatoorah\Config;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\CancelationPolicy;
use Illuminate\Support\Facades\Auth;

class MyFatoorah implements GatewayInterface
{
    private $API_KEY;
    private $API_URL;
    public $success_url;
    public $name = "MyFatoorah";
    public $method_id;
    public $type = "api";

    public function __construct($method_id)
    {
        $this->method_id = $method_id;

        if (Config::$MODE == "live") {
            $this->API_KEY = Config::$API_KEY;
            $this->API_URL = Config::$API_URL;
            $this->success_url = Config::$SUCCESS_URL;
        } else {
            $this->API_KEY = Config::$TEST_API_KEY;
            $this->API_URL = Config::$TEST_API_URL;
            $this->success_url = Config::$TEST_SUCCESS_URL;
        }
    }

    public function pay($invoiceData)
    {
        $user = Auth::user();
        // $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);

        $postFields = [
            'paymentMethodId' => $invoiceData['method_id'],
            'InvoiceValue'    => $invoiceData['amount'],
            'CallBackUrl'     => Config::$CALLBACK_URL . "?&payment_method_id=" . $this->method_id,
            'ErrorUrl'        => Config::$ERROR_URL,
            //Fill optional data
            'CustomerName'       => $user->name,
            'DisplayCurrencyIso' => 'EGP',
            'MobileCountryCode'  => '+20',
            'CustomerMobile'     => ($user->phone && strlen($user->phone) > 11) ? substr($user->phone, 0, 11) : $user->phone,
            'CustomerEmail'      => $user->email,
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

        return $this->executePayment($postFields);
    }

    public function executePayment($postFields)
    {
        $json = $this->callAPI($this->API_URL . "ExecutePayment", $postFields);

        $res = [
            'InvoiceId' => $json->Data->InvoiceId,
            'PaymentURL' => $json->Data->PaymentURL,
            'CustomerReference' => $json->Data->CustomerReference,
            'RecurringId' => $json->Data->RecurringId,
        ];

        return $res;
    }

    public function makeRefund($course_id)
    {
        $user = Auth::user();
        $course = Course::find($course_id);
        $enroll = Enroll::where('course_id', $course->id)->where('user_id', $user->id)->first();
        $policies = CancelationPolicy::where('course_id', $course_id)->orderBy('days', 'asc')->get();
        $refund_amount = 0;
        if ($policies) {
            $start_date = $course->start_date;
            $remain_days = (int)date("d", strtotime($start_date) - strtotime(now()));

            foreach ($policies as $key => $policy) {
                if ($remain_days <= $start_date) {
                    $refund_amount = ($enroll->final_total * $policy->amount) / 100;
                    break;
                }
            }
        } else {
            $refund_amount = $enroll->final_total;
        }

        $PostFields = [
            'KeyType' => "PaymentId",
            'key' => $enroll->provider_payment_id,
            'RefundChargeOnCustomer' => false,
            'ServiceChargeOnCustomer' => false,
            'Amount' => $refund_amount,
            'CurrencyIso' => 'EGP',
            'Comment' => '',

        ];

        $json = $this->callAPI($this->API_URL . "MakeRefund", $PostFields);

        $data = [];
        if ($json->IsSuccess) {

            $data = [
                'data' => [
                    'enroll_id' => $enroll->id ?? null,
                    'course_id' => $course_id ?? null,
                    'user_id' => $user->id,
                    'refundId' => $json->Data->RefundId,
                    'refundReference' => $json->Data->RefundReference,
                    'amount' =>  $json->Data->Amount,
                    'comment' => $json->Data->Comment,
                    'status'  => 1
                ],
                'status' => 'success'
            ];

            return $data;
        }

        return ['data' => null, 'status' => 'failed'];
    }

    public function callAPI($endpointURL, $postFields = [], $requestType = "POST")
    {
        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $requestType,
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer " . $this->API_KEY, 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

    public function getPaymentStatus($payment_id)
    {
        $postFields = ['key' => $payment_id, 'KeyType' => "PaymentId"];
        $json = $this->callAPI($this->API_URL . "GetPaymentStatus", $postFields);
        $res = $json->Data;

        $data = [
            'payment_id' => $payment_id,
            'invoice_id' => $res->InvoiceId,
            'status' => $res->InvoiceStatus,
            'reference' => $res->InvoiceReference,
            'amount' => $res->InvoiceValue,
        ];

        return $data;
    }

    public function availableMethods($CurrencyIso = "EGP")
    {
        $PostFields = ['InvoiceAmount' => 0, 'CurrencyIso' => $CurrencyIso];
        return $this->initiatePayment($PostFields);
    }

    public function initiatePayment($postFields)
    {
        $json = $this->callAPI($this->API_URL . "InitiatePayment", $postFields);
        return $json->Data->PaymentMethods;
    }

    public function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }
}
