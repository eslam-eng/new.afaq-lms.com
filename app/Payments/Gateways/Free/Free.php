<?php

namespace App\Payments\Gateways\Free;

use App\Payments\Gateways\GatewayInterface;
use App\Payments\Gateways\Free\Config;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\Payment;
use App\Models\CancelationPolicy;
use Illuminate\Support\Facades\Auth;

class Free implements GatewayInterface
{


    public $name = "Free";
    public $method_id;
    public $type = "offline";
    public $success_url;
    public $CALLBACK_URL;
    public $ERROR_URL;


    public function __construct($method_id = null)
    {
        $this->method_id = $method_id;
        if (Config::$MODE == "live") {
            $this->CALLBACK_URL = Config::$CALLBACK_URL;
            $this->ERROR_URL = Config::$ERROR_URL;
            $this->success_url = Config::$SUCCESS_URL;
        } else {
            $this->CALLBACK_URL = Config::$TEST_CALLBACK_URL;
            $this->ERROR_URL = Config::$TEST_ERROR_URL;
            $this->success_url = Config::$TEST_SUCCESS_URL;
        }
    }

    public function pay($invoiceData)
    {
        $invoice_id = rand(1000000, 9999999);
        if(isset($invoiceData['package_id'])){
            $this->CALLBACK_URL = '/ar/pay_business_checkout/pay/complete';
        }
        $res = [
            'InvoiceId' => $invoice_id,
            'PaymentURL' => $this->CALLBACK_URL . "?payment_method_id=free&paymentId=" . $invoice_id,
            'paymentMethodId' => isset($invoiceData['method_id']) ? $invoiceData['method_id'] : null,
            'CustomerReference' => $invoice_id,
            'RecurringId' => $invoice_id,
        ];

        return $res;
    }


    public function getPaymentStatus($payment_id)
    {
        $payment = Payment::where('payment_number', $payment_id)->first();
        $data = [
            'payment_id' => $payment_id,
            'invoice_id' => $payment_id,
            'status' => "Paid",
            'reference' => $payment_id,
            // 'amount' => $payment->amount,
            // 'user_id' => $payment->user_id,

        ];

        return $data;
    }
}
