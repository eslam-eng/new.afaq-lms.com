<?php

namespace App\Http\Controllers;

use App\Events\PopUserNotification;
use App\Http\Requests\Carts\ApplyCouponRequest;
use App\Models\Cart;
use App\Models\CouponCode;
use App\Models\CartItem;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Enroll;
use App\Models\PaymentDetails;
use App\Models\PaymentMethod;
use App\Models\BankList;
use App\Models\User;
use App\Models\UsersCourse;
use App\Models\BankInvoice;
use App\Notifications\InvoiceAfterCoursePaymentNotification;
use App\Notifications\InvoiceBankTransfereCoursePAymentNotification;
use App\Notifications\RealTimeNotification;
use Illuminate\Http\Request;
use App\Payments\Factory;
use App\Http\Requests\Payments\bankConfirmRequest;
use App\Http\Requests\StoreCourseInvoiceRequest;
use App\Models\Exam;
use App\Models\PaymentExamDetails;
use App\Models\UserExam;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // $user = auth()->user();
        // $notificationData = [
        //     'user_id' => $user->id,
        //     'message' => 'item added on cart! 😄',
        //     'title_en' => 'cart',
        //     'title_ar' => 'cart',
        //     'message_en' => 'cart',
        //     'message_ar' => 'cart المرور',
        //     'type' => 'cart',
        //     'parent_id' => null,
        // ];

        // event(new PopUserNotification( $notificationData));
        // Notification::send($user, (new RealTimeNotification($notificationData))->delay(now()->addMinutes(3)));
   
        $payment_methods = null;
        $cart = null;
        if (auth()->check()) {
            $user = auth()->user();
            $cart = Cart::check_cart();

            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
            $wallet_balance= ($wallet) ? $wallet->balance: null ;

            $this->update_cart_total($cart);

            $payment_methods = $cart->final_total > 0 ? PaymentMethod::where('status', 1)->where('type', 'api')->orderBy('order', 'asc')->get() : [];
        }
        return view('frontend.carts.index', compact('cart', 'payment_methods' ,'wallet_balance'));
    }

    public function choose_payment_methods(Request $request)
    {
        $payment_methods = [];
        if (auth()->check()) {
            $user = auth()->user();

            if (request('payment_id')) {
                $payment_id = request('payment_id');
                $payment =  Payment::where('transaction',  $payment_id)->first();
                $items = $payment->payment_details;
                $payment_methods =  PaymentMethod::where('status', 1)->where('type', 'api')->where('provider', '!=', 'Bank')->orderBy('order', 'asc')->get();
                return view('frontend.carts.unpaid_invoices', compact('payment_methods', 'items', 'payment_id'));
            } elseif (request('exam_id')) {
                $exam = Exam::findOrFail(request('exam_id'));
                $payment_methods = $exam->price > 0 ? PaymentMethod::where('status', 1)->where('type', 'api')->orWhere('provider', 'Bank')->orderBy('order', 'asc')->get() : [];
                return view('frontend.exam.exam_checkout', compact('exam', 'payment_methods'));
            } else {
                $cart = Cart::check_cart();
                $this->update_cart_total($cart);
                $payment_methods = $cart->final_total > 0 ? PaymentMethod::where('status', 1)->where('type', 'api')->orWhere('provider', 'Bank')->orderBy('order', 'asc')->get() : [];
                if ($cart->items->count()) {
                    return view('frontend.carts.step2', compact('cart', 'payment_methods'));
                } else {
                    return redirect()->route('admin.my_invoices', ['locale' => app()->getLocale()]);
                }
            }
        }

        return back();
    }

    public function store($lang, $course_id)
    {
        $user = auth()->user();
        $course = Course::find($course_id);
        if (!$course) {
            return back()->with('error', 'course not found');
        }

        if (auth()->check()) {
            if ($course->today_price == null && strval($course->today_price) == '') {
                return redirect()->back()->with('error', 'Not Available for your specialty');
            } else {
                $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
                $data['course_id'] = $course_id;
                $data['cart_id'] = $cart->id;
                $data['course_price'] = $course->today_price;
                $data['user_id'] = $user->id;
                CartItem::firstOrCreate([
                    'course_id' => $course_id,
                    'user_id' => $user->id,
                    'cart_id' => $cart->id,
                ], $data);
                $this->update_cart_total($cart);
                // // $delay = \Carbon\Carbon::now()->addMinutes(3);
                // $notificationData = [
                //     'user_id' => $user->id,
                //     'message' => 'item added on cart! 😄',
                //     'title_en' => 'cart',
                //     'title_ar' => 'cart',
                //     'message_en' => 'cart',
                //     'message_ar' => 'cart المرور',
                //     'type' => 'cart',
                //     'parent_id' => null,
                // ];

                // event(new PopUserNotification( $notificationData));
                // // $user->notify( new RealTimeNotification([
                // //     'user_id' => $user->id,
                // //     'message' => 'item added on cart! 😄',
                // //     'title_en' => 'cart',
                // //     'title_ar' => 'cart',
                // //     'message_en' => 'cart',
                // //     'message_ar' => 'cart المرور',
                // //     'type' => 'cart',
                // //     'parent_id' => null,
                // // ]));

                // Notification::send($user, (new RealTimeNotification($notificationData))->delay(now()->addMinutes(3)));
            }
        }

        return redirect(app()->getLocale() . '/carts');
    }

    public function destroy($lang, $course_id)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            CartItem::where([
                'course_id' => $course_id,
                'cart_id' => $cart->id,
                'user_id' => $user->id
            ])->delete();
            $p_details = PaymentDetails::where([
                'course_id' => $course_id,
                'status' => 0,
                'user_id' => $user->id
            ])->first();

            if ($p_details) {

                $p_details->enrolls()->delete();
                $p_details->payments()->delete();
                $p_details->delete();
            }

            $this->update_cart_total($cart);
            if ($cart->wallet) {
                $wallet = Wallet::where('user_id' , $user->id)->first();
                $wallet->update(['balance' => $wallet->balance + $cart->wallet_discount]);
                $cart->update(['wallet_discount' => null , 'wallet' => False]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }


        return back()->with('message', __('global.delete_account_success'));
    }

    public function create_invoice_by_admin(StoreCourseInvoiceRequest $request, $lang)
    {
        $data = $request->validated();

        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $courses_ids = $data['courses_ids'];
        $user_id = $data['user_id'];
        unset($data['courses_ids']);

        BankInvoice::updateOrCreate($data);
        $courses = Course::select('id')->whereIn('id', $courses_ids)->get();

        if ($courses) {

            $cart = Cart::firstOrCreate(['user_id' => $user_id, 'status' => 0, 'created_by' => 'admin']);
            foreach ($courses as $key => $course) {

                $course = Course::find($course->id);
                $item['course_id']      = $course->id;
                $item['cart_id']        = $cart->id;
                $item['course_price']   = $course->getTodayPriceAttribute($user_id);
                $item['user_id']        = $user_id;

                CartItem::firstOrCreate($item);
            }
        }


        $this->update_cart_total($cart);

        return redirect('/' . app()->getLocale() . '/checkout/' . $cart->id . "/" . $user_id);
    }

    public function complete_invoice_by_admin(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $payment = Payment::where('transaction', $invoice_id)->first();
        $bank_invoice = BankInvoice::where('user_id', $payment->user_id)->where('invoice_id', null)->latest()->first();
        $bank_invoice->update(['invoice_id' => $invoice_id]);

        return redirect('/admin/course-invoices/' . $bank_invoice->id)->with('message', 'Invoice has been created');
    }

    public function checkout(Request $request, $lang, $cart_id, $user_id = null)
    {

        $payment_method = ($user_id) ? 7 : ($request->payment_method ?? null); // 4 is ID of Bank Method ;
        if ($payment_method === null) {
            return back()->with('message', app()->getLocale() == 'en' ? 'Please ,Choose The Payment Method' : 'من فضلك اختر طريقه الدفع');
        }

        $user = ($user_id) ? User::where('id', $user_id)->first() : auth()->user();


        $paymentGateway = Factory::make($payment_method);
        $cart = Cart::check_cart();

        if (!$cart->items->count() && !request('payment_id')) {

            return redirect()->route('admin.my_invoices', ['locale' => app()->getLocale()]);
        }
        if (request('exam_id')) {
            $exam = Exam::findOrFail(request('exam_id'));
            $amount = $exam->price;
            $data  = [
                'amount' => $amount ??  0,
                'method_id' => $paymentGateway->method_id,
                'exam_id' => request('exam_id')
            ];
        } elseif (request('payment_id')) {
            $items = CartItem::where('invoice_id', request('payment_id'))->get();
            $amount = $this->get_items_total($items, request('payment_id'));
            $data  = [
                'amount' => $amount ??  0,
                'method_id' => $paymentGateway->method_id,
                'payment_id' => request('payment_id')
            ];
        } else {
            $amount = $cart->final_total;
            $this->update_cart_total($cart);
            $data  = [
                'amount' => $amount > 0 ? $amount : 0,
                'method_id' => $paymentGateway->method_id
            ];
        }


        $payment = $paymentGateway->pay($data);

        if (isset($payment['PaymentURL'])) {

                $payment_item = Payment::firstOrCreate(
                    [
                        'provider' => $paymentGateway->name,
                        'transaction' => $payment['InvoiceId'],
                    ],
                    [
                        'payment_method_id' => $paymentGateway->method_id,
                        'provider' => $paymentGateway->name,
                        'payment_number' => $payment['InvoiceId'],
                        'user_id' => $user->id,
                        'amount' => $amount,
                        'status' => $paymentGateway->name == "Bank" ? 0 : 3,
                        'initial_response' => isset($payment['response']) ? $payment['response'] : null,
                        'wallet' => $cart->wallet,
                        'wallet_discount' => $cart->wallet_discount
                    ]
                );
            return redirect($payment['PaymentURL']);
        } else {
            dd('there is no payment url');
        }
    }

    public function checkout_complete(Request $request)
    {
        $response_msg = 'some thing wrong in payment process ,try again or contact with AFAQ admin.';
        try {
            DB::beginTransaction();
            if ($request->payment_method_id) {
                $paymentGateway = Factory::make($request->payment_method_id);
                $response = $paymentGateway->getPaymentStatus($paymentGateway->name == "Hyber" ? $request->resourcePath : $request->paymentId);
            } elseif ($request->type == 'Tabby') {
                $payment_method = PaymentMethod::where('provider', 'Tabby')->first();
                $paymentGateway = Factory::make($payment_method->id);
                $response = $paymentGateway->getPaymentStatus($paymentGateway->name == "Tabby" ? $request->payment_id : '');
            }

            $user = isset($response['user_id']) ?  User::where('id', $response['user_id'])->first() : auth()->user();

            if (isset($response['status'])) {
                $payment_response = isset($response['response']) ? json_decode($response['response']) : null;
                $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                if (request('payment_id') && $response['status'] == 'Paid' && request('type') != 'Tabby') {
                    $payment_item = Payment::where('transaction', request('payment_id'))->first();
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

                    if (request('payment_id')) {
                        $payment_id = request('payment_id');
                        $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                        $items = CartItem::where('invoice_id', $payment_id)->get();
                    } else {
                        $cart = Cart::where(['user_id' => $user->id, 'status' => 0])->latest()->first();
                        $items = $cart->items;
                        $payment_id = ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']);
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

                    $discount_cash = 0; // Cash Discount For Each Course in Cart
                    $discount_exists = false;
                    if (!request('payment_id')) {
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

                                if(!PaymentDetails::where([
                                    'course_id' => $item->course->id,
                                    'user_id' => $user->id])->exists()){
                                        PaymentDetails::updateOrCreate(
                                            [
                                                'course_id' => $item->course->id,
                                                'user_id' => $user->id,
                                                'status' => $paymentGateway->name == "Bank" ? 0 : ($response['status'] == 'Paid' ? 1 : 0),
                                                'payment_number' => $payment_id
                                            ],
                                            $i
                                        );
                                    }

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
                            if (request('payment_id')) {
                                // Payment::where('transaction', $payment_id)->delete();
                                // Enroll::where('provider_payment_id', $payment_id)->delete();
                                // CartItem::where('invoice_id', $payment_id)->delete();
                                // $this->update_cart_total($cart);
                                Enroll::where('provider_payment_id', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->update(['status' => 1, 'approved' => 1]);
                                $payment = Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->first();
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
                    try {
                        // $data =[
                        //     'user_id' => $user->id,
                        //     'message' => 'InvoiceAfterCoursePaymentNotification!',
                        //     'title_en' => 'password has been changed!',
                        //     'title_ar' => 'password has been changed!',
                        //     'message_en' => 'password has been changed!',
                        //     'message_ar' => 'password has been changed!',
                        //     'type' => 'user',
                        //     'parent_id' => null,
                        // ];
                        // // Notification::send($user, new InvoiceAfterCoursePaymentNotification($item,$user));
                        // if ($paymentGateway->name != 'Bank') {
                        //     Notification::send($user, new InvoiceAfterCoursePaymentNotification($items, $user,$data));
                        // } else {
                        //     Notification::send($user, new InvoiceBankTransfereCoursePAymentNotification($items));
                        // }
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

                return redirect($paymentGateway->success_url . "?invoice_id=" . ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->with('message', app()->getLocale() == 'en' ? 'Enrollment Courses Successfully' : 'تم الالتحاق  في الدورات بنجاح');
            } else {
                DB::commit();
                $response_msg = is_string($response) ? $response : 'some thing wrong in payment process ,try again or contact with SNA admin.';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect(app()->getLocale() . '/carts')->with('error', $response_msg);
    }

    public function checkout_error(Request $request)
    {
        if($request->type =='Tabby'){
            $error = app()->getLocale() == 'en' ? 'Sorry, Tabby is unable to approve this purchase. Please use an alternative payment method for your order.' : 'نأسف، تابي غير قادرة على الموافقة على هذه العملية. الرجاء استخدام طريقة دفع أخرى.';
        }else{
            $error=app()->getLocale() == 'en' ? 'Payment has been failed' : 'حدث خطآ في الدفع';
        }
        // $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Payment has been failed.");
        return redirect()->route('admin.carts',['locale'=>app()->getLocale()])->with('error', $error);
    }

    public function banktransfer(Request $request)
    {
        $invoice_id = $request->invoice_id;
        return view('frontend.payments.bank', compact('invoice_id'));
    }

    public function banktransfer_confirm_form(Request $request)
    {
        $banks = BankList::whereStatus(1)->get();
        $payment_methods = PaymentMethod::where('provider', 'Bank')->whereStatus(1)->orderBy('order', 'asc')->get();
        $invoice_id = $request->invoice_id;

        $payment = Payment::where('transaction', $invoice_id)->where('user_id', auth()->user()->id)->where('status', 0)->first();

        if (!$payment) {
            return back();
        }
        return view('frontend.payments.bank_confirm', compact('payment', 'banks', 'payment_methods', 'invoice_id'));
    }

    public function banktransfer_confirm(bankConfirmRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = auth()->user();
            $data['user_id'] = auth()->user()->id;

            $invoice = BankInvoice::updateOrCreate($data);

            if ($request->file('invoice_image', false)) {
                $invoice->addMedia(($request->file('invoice_image')))->toMediaCollection('invoice_image');
            }
            if ($request->exam_id) {
                Payment::where('transaction', $invoice->invoice_id)->update(['status' => 1]);
                PaymentDetails::where('payment_number', $invoice->invoice_id)->update(['status' => 1]);
            } else {
                $cart_item = CartItem::where([
                    'invoice_id' => $invoice->invoice_id,
                    'user_id' => $user->id
                ])->delete();

                $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
                $this->update_cart_total($cart);
                Enroll::where('provider_payment_id', $invoice->invoice_id)->update(['status' => 1]);
                Payment::where('transaction', $invoice->invoice_id)->update(['status' => 1]);
                PaymentDetails::where('payment_number', $invoice->invoice_id)->update(['status' => 1]);
            }


            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Invoice Payment has been Uploaded , Please Wait For Reviewing.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect(app()->getLocale() . "/my_invoices")->with('message', app()->getLocale() == 'en' ? 'Your Payment has been Uploaded , Please Wait For Reviewing' : 'تم ارسال صوره الايصال ، من فضلك انتظر الموافقه');
    }

    public function update_cart_total($cart)
    {
        if ($cart) {
            $total = 0;
            $final = 0;
            $coupon_discount = 0;
            $coupon = null;

            foreach ($cart->items as $item) {

                if ($item->course) {

                    if ($item->coupon) {
                        $coupon = CouponCode::where('coupon_text', $item->coupon)->first();
                        $enroll_count = Enroll::where('coupon', $item->coupon)->count();

                        if ($coupon && $enroll_count == $coupon->coupon_use_number) {
                            $total += (float)$item->course->today_price;
                            $final += (float)$item->course->today_price;
                            $coupon = null;
                            $item->update([
                                'course_price' => $item->course->today_price,
                                'coupon' => null,
                                'coupon_discount' => null
                            ]);
                        } else {
                            if ($item->coupon) {
                                $item->update(['course_price' => $item->course->today_price - $item->coupon_discount]);
                                $total += (float)$item->course->today_price;
                                $final += (float)$item->course->today_price - $item->coupon_discount;
                                $coupon_discount += $item->coupon_discount;
                                $coupon = $item->coupon;
                            }
                        }
                    } else {
                        $item->update(['course_price' => $item->course->today_price]);
                        $total += (float)$item->course->today_price;
                        $final += (float)$item->course->today_price;
                    }

                    if (strtotime($item->course->end_register_date) < strtotime(now())) {
                        $item->delete();
                    }
                } else {
                    $item->delete();
                }
            }

            if($cart->wallet){
                $final = $final - $cart->wallet_discount;
            }

            $cart->update(['coupon_discount' => $coupon_discount, 'total' => $total, 'final_total' => $final, 'coupon' => $coupon]);
        }
    }

    public function get_items_total($items, $payment_id)
    {
        $total = 0;
        $final = 0;
        $coupon_discount = 0;
        $coupon = null;
        if (count($items)) {
            foreach ($items as $item) {
                if ($item->course) {
                    $total += (float)$item->course->today_price;
                    $final += (float)$item->course->today_price - $item->coupon_discount;
                    $coupon_discount += $item->coupon_discount;
                    $coupon = $item->coupon;
                }
            }
        }

        if (!count($items)) {
            $total = Payment::where('transaction', $payment_id)->amount;
            }
            return $total;
        }

        public function apply_coupon(ApplyCouponRequest $request)
        {
            $data = $request->validated();

            $user = auth()->user();
            $coupon = CouponCode::whereCouponText($data['coupon_text'])->first();

            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            $discount = ($coupon->coupon_type == "percentage") ? (($cart->total * $coupon->coupon_amount) / 100) : $coupon->coupon_amount;
            $cart->coupon = $data['coupon_text'];
            $cart->coupon_discount = $discount;
            $final = $cart->total - $discount;
            $cart->final_total = $final;
        $cart->update();
        try {
            $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " use " . $cart->coupon . " coupon.");
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect(app()->getLocale() . '/carts?coupon=' . $data['coupon_text'])->with('coupon_applied', true);
    }

    public function apply_coupon_item(ApplyCouponRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();
        $item = CartItem::find($request->item_id);

        $coupon = CouponCode::whereCouponText($data['coupon_text'])->whereHas('courses', function ($courses) use ($item) {
            $courses->where('course_id', $item->course_id);
        })->first();
        $coupon_used_number = Enroll::where('coupon', $data['coupon_text'])->count();

        if ($coupon && $coupon_used_number < $coupon->coupon_use_number) {
            $discount = ($coupon->coupon_type == "percentage") ? (($item->course_price * $coupon->coupon_amount) / 100) : $coupon->coupon_amount;
            if ($discount > $item->course_price) {
                return redirect()->route('admin.carts', ['locale' => app()->getLocale(), 'coupon_not_av' => true]);
            } else {
                $item->coupon = $data['coupon_text'];
                $item->coupon_discount = $discount;
                $final = $item->course_price - $discount;
                $item->course_price = $final;
                $item->update();

                $cart = Cart::find($item->cart_id);
                $this->update_cart_total($cart);
            }
        } else {
            return redirect()->route('admin.carts', ['locale' => app()->getLocale(), 'coupon_not_av' => true]);
        }
        try {
            $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " use " . $item->coupon . " coupon.");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect(app()->getLocale() . '/carts?coupon=' . $data['coupon_text'])->with('coupon_applied', true);
    }

    public function remove_coupon_item($lang, $item_id)
    {
        $item = CartItem::find($item_id);
        if ($item) {
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " remove " . $item->coupon . " coupon.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            $item->course_price = $item->coupon_discount + $item->course_price;
            $item->coupon = null;
            $item->coupon_discount = null;
            $item->update();

            $cart = Cart::find($item->cart_id);

            $this->update_cart_total($cart);
        }

        return redirect($lang . '/carts');
    }

    // public function checkout_exam_complete(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $paymentGateway = Factory::make($request->payment_method_id);
    //         $response = $paymentGateway->getPaymentStatus($paymentGateway->name == "Hyber" ? $request->resourcePath : $request->paymentId);

    //         if (isset($response['status']) && $response['status'] == "Paid") {
    //             $payment = Payment::where('transaction', ($payment_response ? $payment_response->merchantTransactionId : $response['invoice_id']))->where('status', 0)->first();
    //             if ($payment) {
    //                 if (isset($paymentGateway) && $paymentGateway->name != 'Bank') {
    //                     $payment->update(['status' => 1, 'approved' => 1]);
    //                 }
    //                 $exam = Exam::findOrFail($request->exam_id);
    //                 $user = auth()->user();
    //                 PaymentExamDetails::updateOrCreate(
    //                     [
    //                         'exam_id' => $exam->id,
    //                         'user_id' => $user->id,
    //                         'status' => $paymentGateway->name == "Bank" ? 0 : 1,
    //                         'payment_number' => $payment->payment_number,
    //                     ],
    //                     [
    //                         'payment_id' => $payment->id,
    //                         'exam_name_en' => $exam->title_en,
    //                         'exam_name_ar' => $exam->title_ar,
    //                         'exam_image_url' => $exam->image->getUrl() ?? null,
    //                         'user_name_en' => $user->full_name_en ?? $user->name,
    //                         'user_name_ar' => $user->full_name_ar ?? $user->name,
    //                         'price' => $exam->price > 0 ? $exam->price : 0,
    //                         'offer' => 0,
    //                         'final_price' => $exam->price > 0 ? $exam->price : 0,
    //                         'status' => $paymentGateway->name == "Bank" ? 0 : 1,
    //                         'created_at' => now(),
    //                         'updated_at' => now()
    //                     ]
    //                 );

    //                 $data['user_id'] = $user->id;
    //                 $data['exam_id'] = $request->exam_id;
    //                 UserExam::firstOrCreate($data);

    //                 DB::commit();
    //             }

    //             return redirect()->route('admin.my_exams', app()->getLocale())->with('message', 'Enrolled Successfully');
    //         } else {

    //             return back()->with('error', 'some thing wrong in payment');
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //     }
    // }

    public function UseWallet()
    {
        try {
            $user = auth()->user();

            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);

            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            if ((!$wallet || $wallet->balance < 1 || !$wallet->status) && !$cart->wallet) {
                return back()->with('error', 'this user wallet balance not available.');
            }

            if ($cart->items->count() < 1) {
                return back()->with('error', 'there is no items in cart.');
            }

            if ($cart->wallet == 0 && request('use_wallet') == 1) {
                if ($cart->final_total > $wallet->balance) {
                    $final_total = $cart->final_total - $wallet->balance;
                    $wallet_discount = $wallet->balance;
                    $wallet_balance = 0;
                } else {
                    $final_total = 0;
                    $wallet_discount = $cart->final_total;
                    $wallet_balance = $wallet->balance - $cart->final_total;
                }

                $data['wallet'] = true;
                $data['final_total'] = $final_total;
                $data['wallet_discount'] = $wallet_discount;
                $data['balance'] = $wallet_balance;
                $cart->update($data);
                $wallet->update(['balance' => $wallet_balance]);
            } elseif ($cart->wallet == 1 && request('use_wallet') == 0 ) {
                $final_total = $cart->final_total + $cart->wallet_discount;
                $wallet_discount = null;
                $wallet_balance = $wallet->balance  + $cart->wallet_discount;


                $data['wallet'] = false;
                $data['final_total'] = $final_total;
                $data['wallet_discount'] = $wallet_discount;
                $cart->update($data);
                $wallet->update(['balance' => $wallet_balance]);


            }else{

                $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            }

            $data = ['final_total'=> $cart->final_total , 'balance' => $wallet_balance ? $wallet_balance : 0 ];
            return $this->toJson($data , 200 , 'use_wallet' , true);
            // return back()->with(['message'=> trans('afaq.done_successfully') , 'final_total'=> $cart->final_total , 'balance' => $wallet_balance ? $wallet_balance : 0 ]);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    // public function check_cart(){
    //     $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id, 'status' => 0]);
    //     foreach($cart->items as $item){
    //         if($item->course->soldOut()){
    //             $item->removeItem();
    //         }
    //     }
    //     return $cart;
    // }
}
