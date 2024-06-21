<?php

namespace App\Http\Controllers\Actions\Migration;

use App\DataLoader\Core\Loader;
use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\BankInvoice;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UsersCourse;
use App\Scopes\PublishedScope;
use Illuminate\Support\Facades\DB;

class PaymentsMigration extends MigrateOldData
{
    public function paymentsMigrate()
    {

        $map_payments = [
            'payment_method' => 'provider',
            'customer_id' => 'user_id',
            'total' => 'amount',
            'extra_data' => 'fullresponse'
        ];

        $load = Loader::apply($map_payments, 'mod_sales_invoice', 'payments');

        sleep(60);

        if ($load) {
            $payments = Payment::all();
            foreach ($payments as $payment) {
                $payment->approved = 1;

                if (!$payment->qr_image) {
                    $qrcode = \QrCode::size(155)->generate(route('invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $payment->id]));
                    $payment->qr_image = $qrcode;
                }

                switch ($payment->provider) {
                    case 'HyperPay':
                        $checkout_id = json_decode($payment->fullresponse);
                        if (is_object($checkout_id)) {
                            $old_hyper_info = DB::connection('afaq_source')->table('mod_sales_hyperpay_checkout')->where('checkout_id', $checkout_id->chid)->first();
                            if ($old_hyper_info) {
                                $payment->initial_response = $old_hyper_info->result;
                                $payment->status_response = $old_hyper_info->result;

                                switch ($old_hyper_info->type) {
                                    case 'card':
                                        $payment_method = PaymentMethod::where('name_en', 'MASTER')->first();
                                        break;
                                    case 'mada':
                                        $payment_method = PaymentMethod::where('name_en', 'MADA')->first();
                                        break;
                                    case 'stc':
                                        $payment_method = PaymentMethod::where('name_en', 'STC_PAY')->first();
                                        break;
                                    case 'apple':
                                        $payment_method = PaymentMethod::where('name_en', 'APPLEPAY')->first();
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                                $payment->provider = 'Hyper';
                                if ($payment_method) {
                                    $payment->payment_method_id = $payment_method->id;
                                }
                                $payment->payment_number = $old_hyper_info->checkout_id;
                                $payment->transaction = $old_hyper_info->checkout_id;
                            }
                        } else {
                            $payment->payment_number  = $payment->id;
                            $payment->transaction  = $payment->id;
                        }
                        break;
                    case 'Bank Transfer':
                        $payment_method = PaymentMethod::where('name_en', 'BankTransfer')->first();
                        if ($payment_method) {
                            $payment->payment_method_id = $payment_method->id;
                        }
                        $payment->provider = 'Bank Transfer';

                        break;
                    case 'Free':
                        $payment_method = PaymentMethod::where('name_en', 'Free')->first();
                        if ($payment_method) {
                            $payment->payment_method_id = $payment_method->id;
                        }

                        break;
                    case 'Cash':
                        $payment_method = PaymentMethod::where('name_en', 'Cash')->first();
                        if ($payment_method) {
                            $payment->payment_method_id = $payment_method->id;
                        }

                        break;
                    default:
                        $payment_method = PaymentMethod::where('name_en', strtoupper($payment->provider))->first();
                        if ($payment_method) {
                            $payment->payment_method_id = $payment_method->id;
                        }
                        $payment->payment_number  = $payment->id;
                        $payment->transaction  = $payment->id;

                        break;
                }

                $payment->save();
            }
        }

        return true;
    }

    public function paymentDetials()
    {
        $map_payments_detials = [
            'invoice_id' => 'payment_id',
            'product_id' => 'course_id',
        ];
        $load = Loader::apply($map_payments_detials, 'mod_sales_invoice_item', 'payment_details');

        sleep(60);
        if ($load) {
            $payment_detials_data = PaymentDetails::all();
            foreach ($payment_detials_data as $payment_detial) {
                $course = Course::find($payment_detial->course_id);
                $payment = Payment::find($payment_detial->payment_id);
                $payment_detial->course_name_en =  $course ? $course->name_en : null;
                $payment_detial->course_name_ar = $course ? $course->name_ar : null;
                $payment_detial->course_image_url = $course ? $course->image : null;
                $payment_detial->user_id = $payment->user_id;
                $payment_detial->payment_number = $payment->payment_number;
                $payment_detial->user_name_en = $payment->user ? $payment->user->full_name_en : null;
                $payment_detial->user_name_ar = $payment->user ? $payment->user->full_name_ar : null;
                $payment_detial->save();
            }
        }

        return true;
    }

    public function enrolls()
    {

        $map_payments_detials = [
            'invoice_id' => 'payment_id',
            'product_id' => 'course_id',
            'price' => 'total',
            'final_price' => 'final_total',
        ];
        $load = Loader::apply($map_payments_detials, 'mod_sales_invoice_item', 'enrolls');

        sleep(60);

        if ($load) {
            $enrolls_data = Enroll::all();
            foreach ($enrolls_data as $enroll) {
                $payment = Payment::find($enroll->payment_id);
                $enroll->user_id = $payment->user_id;
                $enroll->payment_provider = $payment->payment_number;
                $enroll->provider_payment_id = $payment->payment_method_id;
                $enroll->save();
            }
        }

        return true;
    }

    public function bankTransfer()
    {
        $bank_map = [
            'payment_id' => 'invoice_id',
            'payer' => 'bank_name',
            'account_number' => 'bank_number',
            'payment_date' => 'date',
            'total' => 'amount',
            'account_number' => 'bank_number',
        ];

        $load = Loader::apply($bank_map, 'mod_sales_bank_transfer_log', 'bank_invoices');

        sleep(60);
        if ($load) {
            $enrolls_data = BankInvoice::all();
            foreach ($enrolls_data as $enroll) {
                $payment = Payment::find($enroll->invoice_id);
                $enroll->user_id = $payment ? $payment->user_id : null;
                $enroll->invoice_id = $payment ? ($payment->payment_number ?? $payment->id) :  null;
                $enroll->save();
            }
        }

        return true;
    }

    // public function changeMerged()
    // {
    //     $payments  = Payment::all();

    //     foreach ($payments as $payment) {
    //         if (str_contains($payment->payment_number, '-m')) {
    //             $payment->payment_number  = $payment->id;
    //             $payment->transaction  = $payment->id;
    //             $payment->save();
    //         }
    //     }
    // }

    public function userCourses()
    {
        $user_courses = UsersCourse::whereNull('created_at');

        foreach ($user_courses as $user_course) {
            if(!Course::withoutGlobalScope(PublishedScope::class)->where('id',$user_course->course_id)->exists()){
                $user_course->delete();
            }
        }

        $payments  = PaymentDetails::whereBetween('created_at', [date('Y-m-d', strtotime('2022-03-19')), date('Y-m-d', strtotime('2023-03-7'))])->get();

        foreach ($payments as $payment) {
            if ($payment->course_id && $payment->user_id) {
                UsersCourse::updateOrCreate(
                [
                    'user_id' => $payment->user_id,
                    'course_id' => $payment->course_id
                ]);
            }
        }
    }

    public function resolve()
    {
        $payments = Payment::all();
        foreach ($payments as $payment) {
            $user_old = DB::connection('afaq_source')->table('user')->where('customer_id', $payment->user_id)->first();

            if ($user_old) {

                PaymentDetails::where('payment_id', $payment->id)->update([
                    'user_id' => $user_old->id
                ]);
                Enroll::where('payment_id', $payment->id)->update([
                    'user_id' => $user_old->id
                ]);
                UsersCourse::where('user_id', $payment->user_id)->update([
                    'user_id' => $user_old->id
                ]);

                $payment->user_id = $user_old->id;
                $payment->save();
            }
        }
    }

    public function resolvePaymentsCourse()
    {
        $payments = Enroll::whereBetween('created_at', [date('Y-m-d', strtotime('2022-03-19')), date('Y-m-d', strtotime('2023-03-7'))])->get();

        foreach ($payments as $payment) {
            $instructor_data = DB::connection('afaq_source')->table('mod_sales_invoice_item')->where('id', $payment->id)->first();

            if ($instructor_data) {
                $pro_data = DB::connection('afaq_source')->table('mod_sales_product')->where('id', $instructor_data->product_id)->first();
                if ($pro_data) {
                    if ($pro_data->instance_type == 'App\Modules\LMS\Models\Course') {
                        $payment->update([
                            'user_id' => $payment->user_id,
                            'course_id' => $pro_data->instance_id
                        ]);
                    }else{
                        $payment->delete();
                    }
                }
            }
        }
    }

    public function resolvePaymentUserCourses()
    {
        $payment_detials = PaymentDetails::whereBetween('created_at', [date('Y-m-d', strtotime('2022-03-19')), date('Y-m-d', strtotime('2023-03-7'))])->whereNotNull('deleted_at')->withTrashed()->get();
        foreach ($payment_detials as $payment_detial) {
            UsersCourse::whereNull('created_at')->where('user_id', $payment_detial->user_id)->where('course_id', $payment_detial->course_id)->delete();
        }
    }

    public function resolvePaymentDetials()
    {
        $payment_detials_data = PaymentDetails::whereBetween('created_at', [date('Y-m-d', strtotime('2022-03-19')), date('Y-m-d', strtotime('2023-03-7'))])->get();
        foreach ($payment_detials_data as $payment_detial) {
            $course = Course::find($payment_detial->course_id);
            if($course){
                $payment_detial->update([
                    'course_name_en' => $course->name_en,
                    'course_name_ar' => $course->name_ar
                ]);
            }
        }

        return true;
    }
}
