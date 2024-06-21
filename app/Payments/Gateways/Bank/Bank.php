<?php

namespace App\Payments\Gateways\Bank;

use App\Payments\Gateways\GatewayInterface;
use App\Payments\Gateways\Bank\Config;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\Payment;
use App\Models\CancelationPolicy;
use Illuminate\Support\Facades\Auth;

class Bank implements GatewayInterface
{


    public $name = "Bank";
    public $method_id;
    public $success_url;
    public $admin_success_url;
    public $type = "offline";


    public function __construct($method_id)
    {
        $this->method_id = $method_id;
        if (Config::$MODE == "live") {
            $this->CALLBACK_URL = Config::$CALLBACK_URL;
            $this->ERROR_URL = Config::$ERROR_URL;
            $this->success_url = Config::$SUCCESS_URL;
            $this->admin_success_url = Config::$ADMIN_SUCCESS_URL;
        } else {
            $this->CALLBACK_URL = Config::$TEST_CALLBACK_URL;
            $this->ERROR_URL = Config::$TEST_ERROR_URL;
            $this->success_url = Config::$TEST_SUCCESS_URL;
            $this->admin_success_url = Config::$TEST_ADMIN_SUCCESS_URL;
        }


        // $invoice_id = $invoice_id == null ?? time() . rand(100000, 999999);
        // $this->success_url .= "?invoice_id=" . $invoice_id;
    }

    public function pay($invoiceData)
    {

        $invoice_id = time() . rand(100000, 999999);
        if(isset($invoiceData['package_id'])){
            $this->CALLBACK_URL = '/ar/pay_business_checkout/pay/complete';
            $url = $this->CALLBACK_URL . "?payment_method_id=" . $this->method_id . "&paymentId=" . $invoice_id.'&package_id='.$invoiceData['package_id'];
        }

        $res = [
            'InvoiceId' => $invoice_id,
            'PaymentURL' => isset($url) ? $url : $this->CALLBACK_URL . "?payment_method_id=" . $this->method_id . "&paymentId=" . $invoice_id,
            'paymentMethodId' => $invoiceData['method_id'],
            'CustomerReference' => $invoice_id,
            'RecurringId' => $invoice_id,
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

        $data = [
            'data' => [
                'enroll_id' => $enroll->id ?? null,
                'course_id' => $course_id ?? null,
                'user_id' => $user->id,
                'refundId' => $enroll->provider_payment_id,
                'refundReference' => $enroll->provider_payment_id,
                'amount' =>  $refund_amount,
                'comment' => null,
                'status'  => 1
            ],
            'status' => 'success'
        ];

        return $data;
    }


    public function getPaymentStatus($payment_id)
    {
        $payment = Payment::where('provider', $this->name)->where('payment_number', $payment_id)->first();

        if ($payment && $payment->user_id != auth()->user()->id) {
            $this->success_url = $this->admin_success_url;
        }
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
