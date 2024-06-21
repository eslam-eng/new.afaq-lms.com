<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Models\BankInvoice;
use App\Models\BankList;
use App\Models\CancelationPolicy;
use App\Models\CancelPayment;
use App\Models\CancelRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CouponCode;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\PaymentExamDetails;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UsersCourse;
use App\Models\Wallet;
use App\Notifications\InvoiceAfterCoursePaymentNotification;
use App\Notifications\InvoiceBankTransfereCoursePAymentNotification;
use App\Payments\Factory;
use App\Payments\Gateways\Hyber\Hyber;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentApiController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $cart = Cart::check_cart();

        if ($cart->items->count() < 1 && (request('type') != 'change' && !request('transaction_id'))) {
            return $this->toJson(null, 400, 'there is no items in your cart', false);
        }
        $amount = $cart && $cart->final_total > 0 ? $cart->final_total : 0;
        
        $course_non_exclusive = $cart->items->filter(function ($item) {
            return $item->course->has_exclusive_mobile === 0;
        });
    
        $amount = $course_non_exclusive->sum(function ($item) {
            return $item->course_price;
        });

        //change payment
        if (request('transaction_id')) {
            $payment = Payment::where('payment_number', request('transaction_id'))->first();
            $amount = $payment->amount;
        }           

        if($amount == 0){
            $provider = "Free";  
                $paymentGateway = Factory::make();
                $data  = [
                    'amount' => 0,
                    'method_id' => $paymentGateway->method_id
                ];
        }else{
            if (request('type') == 'bank' && !request('transaction_id')) {
                
                $provider = "Bank";
                $method = PaymentMethod::where('provider', 'Bank')->first();
                $paymentGateway = Factory::make($method ? $method->id : 4);
                $data  = [
                    'amount' => $amount > 0 ? $amount : 0,
                    'method_id' => $paymentGateway->method_id
                ];
            } elseif (request('type') == 'Tabby') {

                $provider = "Tabby";
                $method = PaymentMethod::where('provider', 'Tabby')->first();
                $paymentGateway = Factory::make($method ? $method->id : 4);
                $data  = [
                    'amount' => $amount > 0 ? $amount : 0,
                    'method_id' => $method->method_id
                ];
            } elseif (request('type') == 'change' || request('transaction_id')) {
                $items = CartItem::where('invoice_id', request('transaction_id'))->get();
                $amount = $this->get_items_total($items, request('transaction_id'));
                $provider = "Hyber";
                $paymentGateway = new Hyber();
                $data  = [
                    'amount' => $amount > 0 ? $amount : 0,
                    'payment_id' => request('transaction_id')
                ];
            } else {
                if ($amount < 1) {
                    $provider = "Free";
                    $paymentGateway = Factory::make();
                    $data  = [
                        'amount' => 0,
                        'method_id' => $paymentGateway->method_id
                    ];
                } else {
                    $provider = "Hyber";
                    $paymentGateway = new Hyber(request('method_id'));
                    $data  = [
                        'amount' => $amount,
                        'method_id' => $paymentGateway->method_id
                    ];
                }
            }
        }   


        $payment = $paymentGateway->pay($data);
        if (isset($payment['InvoiceId'])) {

            $payment_item = Payment::firstOrCreate(
                [
                    'provider' => $provider,
                    'transaction' => $payment['InvoiceId'],
                ],
                [
                    'payment_method_id' => isset($paymentGateway->method_id) ? $paymentGateway->method_id : null,
                    'payment_number' => $payment['InvoiceId'],
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'status' =>  $paymentGateway->name == "Bank" ? 0 : 3,
                    'initial_response' => isset($payment['response']) ? $payment['response'] : null,
                    'wallet' => $cart->wallet,
                    'wallet_discount' => $cart->wallet_discount
                ]
            );


            return $this->toJson(['checkoutId' => (string)$payment['RecurringId'], 
            'payment_url' => $provider == 'Tabby' ? $payment['PaymentURL'] : '', 'free' => $provider == "Free" ? true : false, 
            'tabby' => $provider == 'Tabby' ? true : false]);
        }

        return $this->toJson(null, 400, 'some thing wrong in payemnt process', false);
    }

    public function checkout_complete(Request $request)
    {
        try {
            DB::beginTransaction();

            $v = Validator::make(request()->all(), [
                'paymentId' => 'required',
                'payment_method' => 'required',
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $payment_method = PaymentMethod::where(function ($q) use ($request) {
                $q->where('provider', $request->payment_method)
                    ->orWhere('name_en', $request->payment_method);
            })->first();
            if (!$payment_method) {
                return $this->toJson(null, 400, 'no payment method with this name', false);
            }

            $paymentGateway = Factory::make($payment_method->id);
            $response = $paymentGateway->getPaymentStatus($paymentGateway->name == "Hyber" ? $request->resourcePath : $request->paymentId);

            $user = isset($response['user_id']) ?  User::where('id', $response['user_id'])->first() : auth()->user();

            if (isset($response['status'])) {
                $payment_response = isset($response['response']) ? json_decode($response['response']) : null;
                $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                if (request('transaction_id') && $response['status'] == 'Paid') {
                    $payment_item = Payment::where('transaction', request('transaction_id'))->first();
                    $payment_item->update(

                        [
                            'transaction' => ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']),
                            'payment_method_id' => $paymentGateway->method_id,
                            'provider' => $paymentGateway->name,
                            'payment_number' => ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']),
                            'user_id' => $user->id,
                            'amount' => $payment_item->amount,
                            'status' => 0,
                            'initial_response' => isset($payment['response']) ? $payment['response'] : null,
                            'wallet' => $payment_item->wallet,
                            'wallet_discount' => $payment_item->wallet_discount,
                        ]
                    );
                }

                $payment = Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->first();
                if ($payment) {
                    $payment->update(['payment_status' => $response['status']]);

                    if (request('transaction_id')) {
                        $payment_id = request('transaction_id');
                        $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                        $items = CartItem::where('invoice_id', $payment_id)->get();
                    } else {
                        $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                        $items = $cart->items;
                        $payment_id = ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']);
                    }

                    if (!$items) {
                        return $this->toJson(null, 400, 'no items in the cart', false);
                    }

                    $enroll_data = $cart->toArray();
                    unset($enroll_data['id']);
                    unset($enroll_data['items']);
                    unset($enroll_data['created_at']);
                    unset($enroll_data['updated_at']);
                    unset($enroll_data['coupon_discount']);
                    unset($enroll_data['created_by']);
                    unset($enroll_data['payment_provider']);
                    unset($enroll_data['payment_method_id']);
                    unset($enroll_data['wallet']);
                    unset($enroll_data['wallet_discount']);

                    $discount_cash = 0; // Cash Discount For Each Course in Cart
                    $discount_exists = false;
                    if (!request('transaction_id')) {
                        foreach ($items as $key => $item) {

                            $coupon = CouponCode::whereCouponText($item->coupon)->first();
                            $enroll_data['course_id'] = $item->course_id;
                            $enroll_data['user_id'] = $item->user_id;
                            $enroll_data['coupon'] = $coupon->coupon_text ?? null;
                            $enroll_data['coupon_type'] = $coupon->coupon_type ?? null;
                            $enroll_data['coupon_amount'] = $coupon->coupon_amount ?? null;
                            $enroll_data['course_price'] =  $item->course_price > 0 ? $item->course_price : 0;
                            $enroll_data['total'] =  $item->course_price > 0 ? $item->course_price : 0;
                            $enroll_data['final_total'] =  ($discount_exists) ?
                                (
                                    ($discount_cash) ?
                                    ($item->course_price - $discount_cash) : ($item->course_price + ($item->course_price * $coupon->coupon_amount  > 0 ? ($item->course_price * $coupon->coupon_amount / 100) : 0))
                                ) : ($item->course_price > 0 ? $item->course_price : 0);
                            $enroll_data['payment_id'] = $payment->id;
                            $enroll_data['approved'] = ($paymentGateway->type == "api" || $paymentGateway->name == "Free") ? 1 : 0;
                            $enroll_data['payment_provider'] = $paymentGateway->name;
                            $enroll_data['provider_payment_id'] = $response['payment_id'];
                            $enroll_data['status'] =  $paymentGateway->name == "Bank" ? 0 : ($response['status'] == 'Paid' ? 1 : 0);
                            if ($response['status'] == 'Paid' || $response['status'] == 'Pending') {
                                UsersCourse::updateOrCreate(['course_id' => $item->course_id, 'user_id' => $user->id]);
                                Enroll::updateOrCreate([
                                    'course_id' => $enroll_data['course_id'],
                                    'user_id'   => $enroll_data['user_id'],
                                ], $enroll_data);
                            }
                        }

                        foreach ($cart->items as $item) {
                            if ($item) {
                                $i = [
                                    'payment_id' => $payment->id,
                                    'course_id' => $item->course->id,
                                    'instructor_id' => null,
                                    'user_id' => $user->id,
                                    'payment_number' => $response['payment_id'], // $payment->payment_number
                                    'course_name_en' => $item->course->name_en,
                                    'course_name_ar' => $item->course->name_ar,
                                    'course_image_url' => $item->course->image->url ?? null,
                                    'instructor_name_en' => null,
                                    'instructor_name_ar' => null,
                                    'user_name_en' => $user->full_name_en ?? $user->name,
                                    'user_name_ar' => $user->full_name_ar ?? $user->name,
                                    'price' => $item->course->today_price > 0 ? $item->course->today_price : 0,
                                    'offer' => ($item->course->today_price - $item->course_price),
                                    'final_price' =>  $item->course_price > 0 ? $item->course_price : 0,
                                    'status' => $paymentGateway->name == "Bank" ? 0 : ($response['status'] == 'Paid' ? 1 : 0),
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ];

                                $item->update([
                                    'status' => $paymentGateway->name == "Bank" ? 0 : 1,
                                    'payment_provider' => $response['status'] == 'Paid' ? $paymentGateway->name : null,

                                    'invoice_id' => ($response['status'] == 'Paid' || $response['status'] == 'Pending') ? $response['payment_id'] : null, // $payment->payment_number
                                ]);

                                PaymentDetails::updateOrCreate(
                                    [
                                        'course_id' => $item->course->id,
                                        'user_id' => $user->id,
                                        'status' => $paymentGateway->name == "Bank" ? 0 : ($response['status'] == 'Paid' ? 1 : 0),
                                        'payment_number' => $payment_id
                                    ],
                                    $i
                                );

                                try {
                                    $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " complete checkout " + $item->course->name_en, +" Course.");
                                } catch (\Throwable $th) {
                                    //throw $th;
                                }
                            }
                        }
                    }

                    if (isset($paymentGateway) && $paymentGateway->name != 'Bank') {
                        if ($response['status'] == 'Paid') {
                            if (request('transaction_id')) {
                                // Payment::where('transaction', $payment_id)->delete();
                                // Enroll::where('provider_payment_id', $payment_id)->delete();
                                // CartItem::where('invoice_id', $payment_id)->delete();
                                // $this->update_cart_total($cart);
                                $payment = Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->first();
                                Enroll::where('payment_id', ($payment ? $payment->id : $response['invoice_id']))->update(['status' => 1, 'approved' => 1]);
                                $payment->update(['status' => 1, 'approved' => 1, 'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1]);
                                PaymentDetails::where('payment_number', $payment_id)->update(['status' => 1, 'payment_id' => $payment->id, 'payment_number' => ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id'])]);
                            } else {
                                CartItem::where('invoice_id', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->delete();
                                $this->update_cart_total($cart);
                                Enroll::where('provider_payment_id', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->update(['status' => 1, 'approved' => 1]);
                                Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->update(['status' => 1, 'approved' => 1]);
                                PaymentDetails::where('payment_number', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->update(['status' => 1]);
                                Cart::where('user_id', $user->id)->delete();
                            }
                        } elseif ($response['status'] == 'Pending') {
                            CartItem::where('invoice_id', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->delete();
                            Cart::where('user_id', $user->id)->delete();
                        }
                    }

                    if ($response['status'] == "Paid") {
                        if ($cart->wallet) {
                            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
                            $balance = $wallet->balance - $cart->wallet_discount;
                            $wallet->update(['balance' => $balance > 0 ? $balance : 0]);
                        }
                        try {
                            $data =[
                                'user_id' => $user->id,
                                'message' => 'InvoiceAfterCoursePaymentNotification!',
                                'title_en' => 'password has been changed!',
                                'title_ar' => 'password has been changed!',
                                'message_en' => 'password has been changed!',
                                'message_ar' => 'password has been changed!',
                                'type' => 'user',
                                'parent_id' => null,
                            ];
                            // Notification::send($user, new InvoiceAfterCoursePaymentNotification($item,$user));
                            if ($paymentGateway->name != 'Bank') {
                                SendNotification([
                                    'title_en' => __('notification.enroll_course_title', [], 'en'),
                                    'message_en' => __('notification.enroll_course_message', [], 'en'),
                                    'title_ar' => __('notification.enroll_course_title', [], 'ar'),
                                    'message_ar' => __('notification.enroll_course_message', [], 'ar')
                                ], null, null, $payment_id, 'my_courses');
                                Notification::send($user, new InvoiceAfterCoursePaymentNotification($items, $user,$data));
                            } else {
                                Notification::send($user, new InvoiceBankTransfereCoursePAymentNotification($items));
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }

                    try {
                        $payment = Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->first();
                        $payment->status_response = json_encode($response);
                        if ($response['status'] == 'Paid' && $payment->provider != 'Bank') {
                            $payment->invoice_number = Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1;
                        }

                        $payment->save();
                    } catch (\Throwable $th) {
                        // throw $th;
                    }
                    DB::commit();
                    if ($response['status'] == 'Paid') {
                        return $this->toJson(true, 200, app()->getLocale() == 'en' ? 'Enrollment Courses Successfully' : 'تم الالتحاق  في الدورات بنجاح');
                    } else {
                        return $this->toJson(false, 422, app()->getLocale() == 'en' ? 'Enrollment Courses Issue' : 'مشكلة فى الحجز');
                    }
                }
            } else {
                DB::commit();
                $response_msg = is_string($response) ? $response : 'some thing wrong in payment process ,try again or contact with AFAQ admin.';
                return $this->toJson(null, 400, $response_msg, false);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function bank_confirm(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = request()->all();
            Log::info('User is accessing ', $data);

            $v = Validator::make($data, [
                "invoice_id" => "required|unique:bank_invoices,invoice_id",
                "date" => "required",
                "bank_id" => "required|exists:bank_lists,id",
                "bank_name" => "required|string",
                "bank_number" => "required|string",
                "invoice_image" => "required|file|mimes:jpeg,png,jpg",
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $user = auth()->user();
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data['date'] = date('Y-m-d', strtotime($request->date));
            $payment = Payment::where('transaction', $request->invoice_id)->first();
            $payment_method = PaymentMethod::where('provider', 'Bank')->first();
            if ($payment_method) {
                $data['payment_method_id'] = $payment_method->id;
            } else {
                $data['payment_method_id'] = 4;
            }

            $data['amount'] = $payment->amount;
            $data['currency'] = $payment->currency ?? 'SR';

            $invoice = BankInvoice::updateOrCreate($data);

            if ($request->file('invoice_image', false)) {
                $invoice->addMedia(($request->file('invoice_image')))->toMediaCollection('invoice_image');
            }

            $cart_item = CartItem::where([
                'invoice_id' => $request->invoice_id,
                'user_id' => $user->id
            ])->delete();

            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            $this->update_cart_total($cart);
            Enroll::where('provider_payment_id', $request->invoice_id)->update(['status' => 1]);
            Payment::where('transaction', $request->invoice_id)->update(['status' => 1, 'payment_method_id' => $data['payment_method_id'], 'wallet' => $cart->wallet, 'wallet_discount' => $cart->wallet_discount, 'amount' => $cart->wallet ? ($payment->amount + $cart->wallet_discount) : $payment->amount]);
            PaymentDetails::where('payment_number', $request->invoice_id)->update(['status' => 1]);

            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Invoice Payment has been Uploaded , Please Wait For Reviewing.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            DB::commit();
            return $this->toJson(true, 200, 'Bank data successfully received.', true);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function get_banks_list()
    {
        $banks = BankList::select('id', 'name_' . app()->getLocale() . ' as bank_name')->whereStatus(1)->get();

        return $this->toJson($banks, 200, 'Bank data successfully received.', true);
    }

    public function get_bank()
    {
        $data =
            [
                'bank_account_number' => config('app.bank_account_number'),
                'bank_iban_number' => config('app.bank_iban_number'),
                'bank_account_name' => trans('global.Company_name')
            ];

        return $this->toJson($data, 200, 'Bank data successfully received.', true);
    }

    public function update_cart_total()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id, 'status' => 0]);
        $cart->total = $cart->items->sum('course_price') + $cart->items->sum('coupon_discount');
        $cart->final_total = $cart->items->sum('course_price');
        $cart->wallet = $cart->total < 1 && $cart->final_total < 1 ? 0 : $cart->wallet;
        $cart->wallet_discount = $cart->total < 1 && $cart->final_total < 1 ? null : $cart->wallet_discount;
        $cart->save();
    }

    public function get_items_total($items, $payment_id = null)
    {
        if (!$payment_id) {
            $total = 0;
            $final = 0;
            $coupon_discount = 0;
            $coupon = null;
            foreach ($items as $item) {
                $total += (float)$item->course->today_price;
                $final += (float)$item->course->today_price - $item->coupon_discount;
                $coupon_discount += $item->coupon_discount;
                $coupon = $item->coupon;
            }
        } else {
            $total = Payment::where('transaction', $payment_id)->first()->amount;
        }

        return $total;
    }

    public function delete_payment($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return $this->toJson(false, 400, 'there is no payment with this id.');
        }

        if ($payment->status == 0 && $payment->approved == 0 && $payment->provider == 'Bank') {
            Enroll::where('provider_payment_id', $payment->transaction)->delete();
            PaymentDetails::where('payment_number', $payment->transaction)->delete();
            BankInvoice::where('invoice_id', $payment->transaction)->delete();
            CartItem::where('invoice_id', $payment->transaction)->delete();
            return $this->toJson($payment->delete() ? true : false);
        } else {
            return $this->toJson(false, 400, 'this payment cannot delete');
        }
    }

    public function refund_course($course_id)
    {
        $cancel_request = CancelRequest::where(['course_id' => $course_id, 'user_id' => auth()->user()->id])->first();
        if (!$cancel_request) {
            $cancellation = CancelationPolicy::with('cancelationValues')->where('course_id', $course_id)->first();
            $enroll = Enroll::with('course')->where(['course_id' => $course_id, 'user_id' => auth()->user()->id])->first();
            if (!$enroll) {
                return $this->toJson(false, 400, 'this course not enrolled');
            }

            $now = new DateTime(now());
            $course_start_date = new DateTime($enroll->course->start_date);

            $days = $course_start_date->diff($now)->format("%a"); //3

            $amount = 0;
            if ($cancellation) {
                foreach ($cancellation->cancelationValues->sortBy('days')->values() as $key => $value) {
                    if ($days <= $value->days) {
                        $amount = $value->amount;
                        break;
                    }
                }
            }
            $price = $enroll->final_total > 0  &&  $amount < $enroll->final_total ? $enroll->final_total - $amount : 0;
            $msg = 'refund course price is ' . get_price($price);
            return $this->toJson(true, 200, $msg);
        } elseif ($cancel_request && $cancel_request->approved == 0) {
            $msg = 'cancel request is pending for admin cancellation';
            return $this->toJson(false, 200, $msg);
        } elseif ($cancel_request && $cancel_request->approved && $cancel_request->status) {
            $msg = 'this course cancelled by admin';
            return $this->toJson(false, 200, $msg);
        }
        return $this->toJson(true);
    }

    public function refund_course_action(Request $request)
    {
        $v = Validator::make(request()->all(), [
            'course_id' => 'required',
            'cancel_reason' => 'required',
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $course_id = $request->course_id;
        $cancellation = CancelationPolicy::with('cancelationValues')->where('course_id', $course_id)->first();
        $enroll = Enroll::with('course')->where(['course_id' => $course_id, 'user_id' => auth()->user()->id])->first();
        if (!$enroll) {
            return $this->toJson(false, 400, 'this course not enrolled');
        }

        $now = new DateTime(now());
        $course_start_date = new DateTime($enroll->course->start_date);

        $days = $course_start_date->diff($now)->format("%a"); //3

        $amount = 0;
        if ($cancellation) {
            foreach ($cancellation->cancelationValues->sortBy('days')->values() as $key => $value) {
                if ($days <= $value->days) {
                    $amount = $value->amount;
                    break;
                }
            }
        }
        $price = $enroll->final_total > 0  &&  $amount < $enroll->final_total ? $enroll->final_total - $amount : 0;

        $cancel_request = CancelRequest::firstOrCreate([
            'course_id' => $request->course_id,
            'user_id' => auth()->user()->id,
            'amount' => $price,
            'type' => null,
            'status' => 1,
            'approved' => 0,
            'cancel_reason' => $request->cancel_reason
        ]);

        return $this->toJson($cancel_request, 200, 'cancel request created successfully');
    }
}
