<?php

namespace App\Payments\Gateways\UrWay;

use App\Payments\Gateways\GatewayInterface;
use App\Payments\Gateways\UrWay\Config;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\CancelationPolicy;
use Illuminate\Support\Facades\Auth;

class UrWay implements GatewayInterface
{
    private $API_URL;
    private $secret_key = "914065b5959e5aac75d45985f352f5cab56be40b3fcfc4ffca58c3f753c24aec";
    private $terminalId = "myevntoo";
    private $password = "myevntoo@123";
    // private $password = "nazil123!@#fgh";
    // public $success_url ;
    public $name = "UrWay";
    public $method_id;
    public $type = "api";

    public function __construct($method_id)
    {
        $this->method_id = $method_id;

        if (Config::$MODE == "live") {
            $this->API_URL = Config::$API_URL;
            $this->success_url = Config::$SUCCESS_URL;
        } else {
            $this->API_URL = Config::$TEST_API_URL;
            $this->success_url = Config::$TEST_SUCCESS_URL;
        }
    }

    public function pay($invoiceData)
    {
        $user = Auth::user();

        $trackId = time() . rand(100000, 999999);
        // $invoiceData['amount'] = 20.00;
        $hash_text = $trackId . "|" . $this->terminalId . "|" . $this->password . "|" . $this->secret_key . "|" . $invoiceData['amount'] . "|SAR";
        // dd($hash_text);
        $hash = hash('sha256', $hash_text);
        // dd($hash);
        $postFields = [
            'trackid'       => $trackId,
            'terminalId'    => $this->terminalId,
            'customerEmail' => $user->email,
            'action'        => "1",
            // 'merchantIp'    => $this->get_server_ip(),
            'customerIp'    => $this->get_server_ip(),
            'password'      => $this->password,
            'currency'      => "SAR",
            'country'       => "SA",
            'amount'        => $invoiceData['amount'],
            "udf1"              => "Test1",
            "udf2"              => Config::$CALLBACK_URL,
            "udf3"              => "",
            "udf4"              => "",
            "udf5"              => "Test5",
            'requestHash' => $hash
        ];

        dd($postFields);             



        return $this->executePayment($postFields);
    }



    public function executePayment($postFields)
    {
        $json = $this->callAPI($this->API_URL, $postFields);

        dd($json);

        $res = [
            'InvoiceId' => $json->Data->InvoiceId,
            'PaymentURL' => $json->Data->PaymentURL,
            'CustomerReference' => $json->Data->CustomerReference,
            'RecurringId' => $json->Data->RecurringId,
        ];

        return $res;
    }

    public function get_server_ip()
    {
        $ipaddress = '10.10.10.10';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
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

        $postFields = json_encode($postFields);
        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $requestType,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => array('ContentType: application/json', 'ContentLength: ' . strlen($postFields)),
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

        // $error = $this->handleError($response);
        // if ($error) {
        //     die("Error: $error");
        // }

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
}
