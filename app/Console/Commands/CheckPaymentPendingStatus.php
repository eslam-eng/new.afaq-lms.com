<?php

namespace App\Console\Commands;

use App\Models\Cart;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\User;
use App\Notifications\InvoiceAfterCoursePaymentNotification;
use App\Notifications\InvoiceBankTransfereCoursePAymentNotification;
use App\Payments\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckPaymentPendingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check payment pending status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = Payment::where('payment_status', 'Pending')->where('status', 0)->where('approved', 0)->get();
        $user = !auth()->check() ?  (request('user_id') ? User::where('id', request('user_id'))->first() : null) : auth()->user();
        if ($user) {
            $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
            $items = $cart->items;

            foreach ($payments as $key => $payment) {
                $paymentGateway = Factory::make($payment->payment_method_id);
                $resourcePath = '/v1/checkouts/' . $payment->transaction . '/payment';
                if ($paymentGateway->name == "Hyber") {
                    $response = $paymentGateway->getPaymentStatus($resourcePath);
                    if (isset($response['status']) && $response['status'] == "Paid") {
                        Enroll::where('provider_payment_id', $response['invoice_id'])->update(['status' => 1, 'approved' => 1]);
                        Payment::where('transaction', $response['invoice_id'])->update(['status' => 1, 'approved' => 1, 'payment_status' => 'Paid']);
                        PaymentDetails::where('payment_number', $response['invoice_id'])->update(['status' => 1]);

                        try {
                            if ($paymentGateway->name != 'Bank') {
                                SendNotification([
                                    'title_en' => __('notification.enroll_course_title', [], 'en'),
                                    'message_en' => __('notification.enroll_course_message', [], 'en'),
                                    'title_ar' => __('notification.enroll_course_title', [], 'ar'),
                                    'message_ar' => __('notification.enroll_course_message', [], 'ar')
                                ],null,null,$payment->id,'my_courses');
                                $data =[
                                    'user_id' => $user->id,
                                    'message' => 'Handle in checkpayment',
                                    'title_en' => 'Handle in checkpayment',
                                    'title_ar' => 'Handle in checkpayment',
                                    'message_en' => 'Handle in checkpayment',
                                    'message_ar' => 'Handle in checkpayment',
                                    'type' => 'course',
                                    'parent_id' => null,
                                ];
                                Notification::send($user, new InvoiceAfterCoursePaymentNotification($items, $user ,$data));
                            } else {
                                Notification::send($user, new InvoiceBankTransfereCoursePAymentNotification($items));
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
        }
    }
}
