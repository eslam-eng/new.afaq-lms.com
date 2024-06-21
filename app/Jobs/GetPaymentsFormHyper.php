<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CouponCode;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\User;
use App\Models\UsersCourse;
use App\Notifications\InvoiceAfterCoursePaymentNotification;
use App\Notifications\InvoiceBankTransfereCoursePAymentNotification;
use App\Payments\Gateways\Hyber\Hyber;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class GetPaymentsFormHyper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
try{
        $all_payments = (new Hyber)->getPaymentsInPeriod();
        foreach ($all_payments['mada_payments'] as $all_payment) {
            $payment_exists = Payment::where('transaction', $all_payment->merchantTransactionId)->first();
            if ($payment_exists) {
                if (isset($all_payment->result) && $all_payment->result->code == '000.000.000' && isset($all_payment->cart)) {
                    $cart = collect($all_payment->cart->items);
                    $payment_exists->update(
                        [
                            'payment_method_id' => 7,
                            'provider' => 'Hyber',
                            'payment_number' => $all_payment->merchantTransactionId,
                            'amount' => $cart->sum('price'),
                            'status' => 0,
                            'initial_response' => isset($payment['response']) ? $payment['response'] : null,
                            // 'wallet' => $cart->wallet,
                            // 'wallet_discount' => $cart->wallet_discount,
                        ]
                    );

                    $payment = Payment::where('transaction', $all_payment->merchantTransactionId)->where('status', 0)->first();
                    if ($payment) {
                        $items = $all_payment->cart->items;
                        $payment_id = $all_payment->merchantTransactionId;


                        $enroll_data = [];

                        $discount_cash = 0; // Cash Discount For Each Course in Cart
                        $discount_exists = false;
                        foreach ($items as $key => $item) {

                            $coupon = CouponCode::whereCouponText($item->name ?? '')->first();

                            $enroll_data['course_id'] = $item->merchantItemId ?? $item->sellerId;
                            $enroll_data['user_id'] = $payment->user->id;
                            $enroll_data['coupon'] = $coupon->coupon_text ?? null;
                            $enroll_data['coupon_type'] = $coupon->coupon_type ?? null;
                            $enroll_data['coupon_amount'] = $coupon->coupon_amount ?? null;
                            $enroll_data['course_price'] =  $item->price > 0 ? $item->price : 0;
                            $enroll_data['total'] =  $item->price > 0 ? $item->price : 0;
                            $enroll_data['final_total'] =  ($discount_exists) ?
                                (
                                    ($discount_cash) ?
                                    ($item->price - $discount_cash) : ($item->price + ($item->price * $coupon->coupon_amount  > 0 ? ($item->price * $coupon->coupon_amount / 100) : 0))
                                ) : ($item->price > 0 ? $item->price : 0);
                            $enroll_data['payment_id'] = $payment->id;
                            $enroll_data['approved'] = 1;

                            $enroll_data['payment_provider'] = 'Hyber';
                            $enroll_data['provider_payment_id'] = $all_payment->merchantTransactionId;
                            if (gettype($enroll_data['course_id']) == "string") {
                                UsersCourse::updateOrCreate(['course_id' => $enroll_data['course_id'], 'user_id' => $payment->user->id]);
                                Enroll::updateOrCreate([
                                    'course_id' => $enroll_data['course_id'],
                                    'user_id'   => $enroll_data['user_id'],
                                    'approved'  => $enroll_data['approved'],
                                ], $enroll_data);
                            }
                        }

                        foreach ($items as $item) {
                            if ($item) {
                                $item_course = Course::withoutGlobalScopes()->find($item->merchantItemId ?? $item->sellerId);
                                $i = [
                                    'payment_id' => $payment->id,
                                    'course_id' => $item_course->id,
                                    'instructor_id' => null,
                                    'user_id' => $payment->user->id,
                                    'payment_number' => $all_payment->merchantTransactionId, // $payment->payment_number
                                    'course_name_en' => $item_course->name_en,
                                    'course_name_ar' => $item_course->name_ar,
                                    'course_image_url' => $item_course->image->url ?? null,
                                    'instructor_name_en' => null,
                                    'instructor_name_ar' => null,
                                    'user_name_en' => $payment->user->full_name_en ?? $payment->user->name,
                                    'user_name_ar' => $payment->user->full_name_ar ?? $payment->user->name,
                                    'price' => $item_course->today_price > 0 ? $item_course->today_price : 0,
                                    'offer' => ($item_course->today_price - $item->price),
                                    'final_price' =>  $item->price > 0 ? $item->price : 0,
                                    'status' => 1,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ];

                                CartItem::where('id', $item->sellerId)->update([
                                    'status' => 1,
                                    'payment_provider' =>  'Hyber',
                                    'invoice_id' =>   $all_payment->merchantTransactionId, // $payment->payment_number
                                ]);


                                PaymentDetails::updateOrCreate(
                                    [
                                        'course_id' => $item_course->id,
                                        'user_id' => $payment->user->id,
                                        'status' => 1,
                                    ],
                                    $i
                                );
                            }
                        }


                        if (request('payment_id')) {
                            Payment::where('transaction', $payment_id)->delete();
                            Enroll::where('provider_payment_id', $payment_id)->delete();
                            Enroll::where('provider_payment_id', $all_payment->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                            $payment = Payment::where('transaction', $all_payment->merchantTransactionId)->first();
                            $payment->update(['status' => 1, 'approved' => 1, 'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1]);
                            PaymentDetails::where('payment_number', $payment_id)->update(['status' => 1, 'payment_id' => $payment->id, 'payment_number' => $all_payment->merchantTransactionId]);
                        } else {
                            Enroll::where('provider_payment_id', $all_payment->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                            Payment::where('transaction', $all_payment->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                            PaymentDetails::where('payment_number', $all_payment->merchantTransactionId)->update(['status' => 1]);
                        }
                    }
                    try {
                        // Notification::send($payment->user, new InvoiceAfterCoursePaymentNotification($item,$payment->user));
                        Notification::send($payment->user, new InvoiceAfterCoursePaymentNotification($items, $payment->user));
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    $payment = Payment::where('transaction', $all_payment->merchantTransactionId)->first();
                    $payment->status_response = json_encode($all_payment);
                    $payment->invoice_number = Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1;
                    $payment->save();
                }

                DB::commit();
            } else {
                DB::commit();
            }
        }

        foreach ($all_payments['visa_payments'] as $all_payment_vs) {
            $payment_exists = Payment::where('transaction', $all_payment_vs->merchantTransactionId)->first();

            if ($payment_exists) {
                    if (isset($all_payment_vs->result) && $all_payment_vs->result->code == '000.000.000' && isset($all_payment_vs->cart)) {
                        $cart = collect($all_payment_vs->cart->items);
                        $payment_item = Payment::firstOrCreate(
                            [
                                'provider' => 'Hyber',
                                'transaction' => $all_payment_vs->merchantTransactionId,
                            ],
                            [
                                'payment_method_id' => 5,
                                'provider' => 'Hyber',
                                'payment_number' => $all_payment_vs->merchantTransactionId,
                                'user_id' => $payment->user->id,
                                'amount' => $cart->sum('price'),
                                'status' => 0,
                                'initial_response' => isset($payment['response']) ? $payment['response'] : null,
                                // 'wallet' => $cart->wallet,
                                // 'wallet_discount' => $cart->wallet_discount,
                            ]
                        );

                        $payment = Payment::where('transaction', $all_payment_vs->merchantTransactionId)->where('status', 0)->first();
                        if ($payment) {
                            $items = $all_payment_vs->cart->items;
                            $payment_id = $all_payment_vs->merchantTransactionId;


                            $enroll_data = [];
                            unset($enroll_data['id']);
                            unset($enroll_data['items']);
                            unset($enroll_data['created_at']);
                            unset($enroll_data['updated_at']);
                            unset($enroll_data['coupon_discount']);
                            unset($enroll_data['created_by']);
                            unset($enroll_data['payment_provider']);
                            unset($enroll_data['payment_method_id']);

                            $discount_cash = 0; // Cash Discount For Each Course in Cart
                            $discount_exists = false;
                            foreach ($items as $key => $item) {

                                $coupon = CouponCode::whereCouponText($item->name ?? '')->first();

                                $enroll_data['course_id'] = $item->merchantItemId ?? $item->sellerId;
                                $enroll_data['user_id'] = $payment->user->id;
                                $enroll_data['coupon'] = $coupon->coupon_text ?? null;
                                $enroll_data['coupon_type'] = $coupon->coupon_type ?? null;
                                $enroll_data['coupon_amount'] = $coupon->coupon_amount ?? null;
                                $enroll_data['course_price'] =  $item->price > 0 ? $item->price : 0;
                                $enroll_data['total'] =  $item->price > 0 ? $item->price : 0;
                                $enroll_data['final_total'] =  ($discount_exists) ?
                                    (
                                        ($discount_cash) ?
                                        ($item->price - $discount_cash) : ($item->price + ($item->price * $coupon->coupon_amount  > 0 ? ($item->price * $coupon->coupon_amount / 100) : 0))
                                    ) : ($item->price > 0 ? $item->price : 0);
                                $enroll_data['payment_id'] = $payment->id;
                                $enroll_data['approved'] = 1;

                                $enroll_data['payment_provider'] = 'Hyber';
                                $enroll_data['provider_payment_id'] = $all_payment_vs->merchantTransactionId;
                                if (gettype($enroll_data['course_id']) == "string") {
                                    UsersCourse::updateOrCreate(['course_id' => $enroll_data['course_id'], 'user_id' => $payment->user->id]);

                                    Enroll::updateOrCreate([
                                        'course_id' => $enroll_data['course_id'],
                                        'user_id'   => $enroll_data['user_id'],
                                        'approved'  => $enroll_data['approved'],
                                    ], $enroll_data);
                                }
                            }

                            foreach ($items as $item) {
                                if ($item) {
                                    $item_course = Course::withoutGlobalScopes()->find($item->merchantItemId ?? $item->sellerId);
                                    $i = [
                                        'payment_id' => $payment->id,
                                        'course_id' => $item_course->id,
                                        'instructor_id' => null,
                                        'user_id' => $payment->user->id,
                                        'payment_number' => $all_payment_vs->merchantTransactionId, // $payment->payment_number
                                        'course_name_en' => $item_course->name_en,
                                        'course_name_ar' => $item_course->name_ar,
                                        'course_image_url' => $item_course->image->url ?? null,
                                        'instructor_name_en' => null,
                                        'instructor_name_ar' => null,
                                        'user_name_en' => $payment->user->full_name_en ?? $payment->user->name,
                                        'user_name_ar' => $payment->user->full_name_ar ?? $payment->user->name,
                                        'price' => $item_course->today_price > 0 ? $item_course->today_price : 0,
                                        'offer' => ($item_course->today_price - $item->price),
                                        'final_price' =>  $item->price > 0 ? $item->price : 0,
                                        'status' => 1,
                                        'created_at' => now(),
                                        'updated_at' => now()
                                    ];

                                    CartItem::where('id', $item->sellerId)->update([
                                        'status' => 1,
                                        'payment_provider' =>  'Hyber',
                                        'invoice_id' =>   $all_payment_vs->merchantTransactionId, // $payment->payment_number
                                    ]);


                                    PaymentDetails::updateOrCreate(
                                        [
                                            'course_id' => $item_course->id,
                                            'user_id' => $payment->user->id,
                                            'status' => 1,
                                        ],
                                        $i
                                    );
                                }
                            }


                            if (request('payment_id')) {
                                Payment::where('transaction', $payment_id)->delete();
                                Enroll::where('provider_payment_id', $payment_id)->delete();
                                Enroll::where('provider_payment_id', $all_payment_vs->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                                $payment = Payment::where('transaction', $all_payment_vs->merchantTransactionId)->first();
                                $payment->update(['status' => 1, 'approved' => 1, 'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1]);
                                PaymentDetails::where('payment_number', $payment_id)->update(['status' => 1, 'payment_id' => $payment->id, 'payment_number' => $all_payment_vs->merchantTransactionId]);
                            } else {
                                Enroll::where('provider_payment_id', $all_payment_vs->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                                Payment::where('transaction', $all_payment_vs->merchantTransactionId)->update(['status' => 1, 'approved' => 1]);
                                PaymentDetails::where('payment_number', $all_payment_vs->merchantTransactionId)->update(['status' => 1]);
                            }
                        }
                        try {
                            // Notification::send($payment->user, new InvoiceAfterCoursePaymentNotification($item,$payment->user));
                            Notification::send($payment->user, new InvoiceAfterCoursePaymentNotification($items, $payment->user));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        $payment = Payment::where('transaction', $all_payment_vs->merchantTransactionId)->first();
                        $payment->status_response = json_encode($all_payment_vs);
                        $payment->invoice_number = Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1;
                        $payment->save();
                    }


                DB::commit();
            } else {
                DB::commit();
            }
        }
} catch (Exception $e) {         }
    }
}
