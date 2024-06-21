<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankInvoice;
use App\Models\CancelRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UsersCourse;
use App\Models\Wallet;
use App\Notifications\ApprovePaymentNotification;
use App\Notifications\CancelByAdminRefundNotification;
use App\Notifications\CancelPaymentRequestNotification;
use App\Policy;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $function = \Request::segment(2);
            $reservations = new Payment;

            $request->request->add(['provider' => $request['amp;provider'], 'date_to' => $request['amp;date_to'], 'wallet' => $request['amp;wallet'],'status' => $request['amp;status']]);
            if (request('provider')) {
                $reservations = $reservations->where('provider', request('provider'));
            }
            if (request('course')) {
                $reservations = $reservations->whereHas('payment_details', function ($payment_details) {
                    $payment_details->where('course_id', request('course'));
                });
            }


            $reservations = $reservations->where('status','!=', 3);

            if (request('status') == 1) {
                $reservations = $reservations->where('status', 0) //status For user upload image , approved for admin approve request
                    ->where('approved', 0);
            } elseif (request('status') == 2) {
                $reservations = $reservations->where('status', 1)
                    ->where('approved', 0);
            } elseif (request('status') == 3) {
                $reservations = $reservations->where('status', 1)
                    ->where('approved', 1)->distinct('user_id');
            }
            //            if (request('status') == 1) {
            //                $reservations = $reservations->whereHas('reservation_enrolls', function ($q) {
            //                    $q->where('status', 0)
            //                        ->where('approved', 0);
            //                });
            //
            //            } elseif (request('status') == 2) {
            //                $reservations = $reservations->whereHas('reservation_enrolls', function ($q) {
            //                    $q->where('status', 1)
            //                        ->where('approved', 0);
            //                });
            //            } elseif (request('status') == 3) {
            //                $reservations = $reservations->whereHas('reservation_enrolls', function ($q) {
            //                    $q->where('status', 1)
            //                        ->where('approved', 1);
            //                });
            //            }
            //            if (request('wallet')) {
            //
            //                $reservations = $reservations->where('wallet', request('wallet'));
            //            }
            if ($function == 'wallet_transaction') {
                $reservations = $reservations->where('wallet', 1);
            }
            /** start date */
            $from = $request->date_from;
            $to = $request->date_to;

            if ($from  && $to) {
                $reservations =  $reservations->whereBetween('created_at', [$from, $to]);
            }

            $reservations = $reservations->whereNull('deleted_at')->orderBy('id', 'desc');
            return DataTables::of($reservations)

                ->addColumn('user_email', function ($row) {
                    return $row->user ? $row->user->email : '';
                })
                ->filterColumn('user_email', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('email', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('pay_failed', function ($row) {
                    if ($row->status_response) {

                        $status = json_decode($row->status_response);

                        if (isset($status->status)) {
                            if ($status->status == 'Failed') {
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                })
                ->addColumn('user_phone', function ($row) {
                    return $row->user ? $row->user->phone : '';
                })
                ->filterColumn('user_phone', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('phone', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('has_enrolls', function ($row) {
                    return $row->payment_enrolls->count();
                })
                ->addColumn('payment_details', function ($row) {
                    return json_encode($row->payment_details->pluck('course_name_' . app()->getLocale()), JSON_UNESCAPED_UNICODE);
                })
                // ->filterColumn('payment_details', function ($query, $keyword) {
                //     $query->whereHas('payment_details', function ($payment_details) use ($keyword) {
                //         $payment_details->whereHas('course', function ($course) use ($keyword) {
                //             $course->where('name_' . app()->getLocale(), 'like', '%' . $keyword . '%');
                //         });
                //     });
                // })
                ->make(true);
        }
        //->groupBy('id')
        $paymethod = Payment::select('provider')->distinct()->groupBy('provider')->get();
        $courses = Course::get();

        return view('admin.reservations.index', compact('paymethod', 'courses'));
    }

    public function show($id)
    {
        $reservation = Payment::withTrashed()->where('id', $id)->first();
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reservation->load('payment_details', 'payment_enrolls', 'user', 'course','payment_invoices');

        return view('admin.reservations.show', compact('reservation'));
    }
    public function show_canceled($id)
    {
        $reservation = Payment::withTrashed()->where('id', $id)->with([
            'payment_details' => function ($payment_details) {
                $payment_details->withTrashed()->where('course_id', request('course_id'));
            },
            'payment_enrolls' => function ($payment_enrolls) {
                $payment_enrolls->withTrashed()->where('course_id', request('course_id'));
            }
        ])->first();
        //    dd($reservation);
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reservation->load('payment_details', 'payment_enrolls', 'user', 'course');
        return view('admin.reservations.show-canceled', compact('reservation'));
    }
    /**
     * Change Status
     */
    public function ChangeStatus(Request $request)
    {
        $input = $request->all();

        $reservation = Payment::with('payment_details')->find($request->reservation_id);
        $reservation->approved = !$reservation->approved;

        $reservation->payment_enrolls()->update(['approved' => $reservation->approved, 'status' => $reservation->approved]);
        // Done about request from administration to change verify even not upload reset
        $reservation->update(['status' => $reservation->approved]);
        $reservation->payment_details()->update(['status' => $reservation->approved]); //with payment_id
        //
        $reservation->save();
        $users = User::where('id', $reservation->user_id)->get();
        if ($reservation->approved == 1) {
            $reservation->update([
                'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1
            ]);
            try {
                $data =[
                    'user_id' => $reservation->id,
                    'message' => __('global.Cancelled_successfully'),
                    'title_en' => 'Cancelled_successfully',
                    'title_ar' => 'Cancelled_successfully',
                    'message_en' => 'Cancelled_successfully',
                    'message_ar' => 'Cancelled_successfully',
                    'type' => 'course',
                    'parent_id' => null,
                ];
                //code...
                Notification::send($users, new ApprovePaymentNotification($reservation ,$data));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        return response()->json(['success' => 'Status change successfully.']);
    }

    /**
     * Cancel Reservation
     */

    public function DeleteReservation(Request $request)
    {
        $reservation = Payment::find($request->reservation_id);
        //        dd($reservation);
        if ($reservation) {
            $course_ids = PaymentDetails::where('payment_id', $reservation->id)->pluck('course_id')->toArray();
            PaymentDetails::where('payment_id', $reservation->id)->delete();
            Enroll::where('payment_id', $reservation->id)->delete();
            BankInvoice::where('invoice_id', $reservation->payment_number)->delete();
            UsersCourse::where('user_id', $reservation->user_id)->whereIn('course_id', $course_ids)->delete();
            UserCertificate::where('user_id', $reservation->user_id)->whereIn('course_id',$course_ids)->delete();
            CartItem::where('user_id', $reservation->user_id)->whereIn('course_id', $course_ids)->delete();
            Payment::where('id', $reservation->payment_id)->delete();

            $reservation->delete();
            return true;
            //        if ($reservation->approved == 1) {
            //            Notification::send($users, new ApprovePaymentNotification($reservation));
            //        }
        }

        return false;
    }

    public function cancelPage(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->with(
            'user',
            'course',
            'payment_details',
            'payment_enrolls'
        )->first();
        return view('admin.reservations.cancel', compact('payment'));
    }

    public function cancel(Request $request)
    {

        $data = $request->all();
//                 dd($data);
        $refound_amount = 0;
        $total_canceled = 0;
        foreach ($data['payment_detials'] as $payment_detail) {
            if (isset($payment_detail['id']) && $payment_detail['id']) {
                $payment_detail['refound_type'] = $data['refound_type'];
                $payment_detail['status'] = 0;
                $payment_detail['deleted_at'] = Carbon::now();
                $pay_det = PaymentDetails::where('id', $payment_detail['id'])->first();
                Enroll::where('payment_id', $data['payment_id'])->where('course_id', $payment_detail['course_id'])->update([
                    'status' => 0,
                    'approved' => 0,
                    'deleted_at' => Carbon::now()
                ]);
                UsersCourse::where('course_id', $pay_det->course_id)->where('user_id', $pay_det->user_id)->delete();
                CancelRequest::updateOrCreate([
                    'course_id' => $pay_det->course_id,
                    'payment_id' => $pay_det->payment_id,
                ], [
                    'course_id' => $pay_det->course_id,
                    'user_id' => auth()->user()->id,
                    'amount' => $pay_det->final_price,
                    'type' => $payment_detail['refound_type'], // Last Edit of cancel request
                    'status' => 1,
                    'approved' => 1,
                    'rejected' => 1, // Last edit

                    'payment_id' => $pay_det->payment_id,
                    'cancel_reason' => $payment_detail['cancel_reason']
                ]);
//                                dd($pay_det);
                $pay_det->update($payment_detail);
                $refound_amount += (float) $payment_detail['refound_amount'];
                $total_canceled += $pay_det->final_price;
            }
        }

        $payment = Payment::find($data['payment_id']);
//        $payment->load('payment_details_canceled');
//        dd($payment);

        if ($payment) {
            $payment->update([
                'refound_amount' => $refound_amount ??  null,
                'refound_type' => $refound_amount > 0 ? $data['refound_type'] : null,
                'amount'  => $payment->amount - $total_canceled
            ]);

            if (isset($data['refound_type']) && $data['refound_type'] == 'wallet') {
                $user_wallet = Wallet::where('user_id', $payment->user_id)->first();
                if ($user_wallet) {
                    $user_wallet->update([
                        'balance' => $user_wallet->balance + $refound_amount
                    ]);
                } else {
                    Wallet::create([
                        'user_id' => $payment->user_id,
                        'currency' => 'SAR',
                        'balance' => $refound_amount,
                        'status' => 1,
                    ]);
                }
            }
            Cart::where('user_id', $payment->user_id)->delete();

            if (!$payment->payment_details->count()) {
                $payment->update([
                    'deleted_at' => Carbon::now()
                ]);

                BankInvoice::where('invoice_id', $payment->payment_number)->delete();
            }
            $course_ids = PaymentDetails::where('payment_id', $payment->id)->pluck('course_id')->toArray();
        }
        $users=User::where('id',$payment->user_id)->get();
//dd($payment);
        try {
            //code...
            Notification::send($users, new CancelByAdminRefundNotification($payment ));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->route('admin.reservations.index');
    }

    public function cancel_payment($payment_id)
    {
        $payment = Payment::find($payment_id);

        if ($payment) {
            BankInvoice::where('invoice_id', $payment->payment_number)->delete();
            Enroll::where('payment_id', $payment->id)->delete();
            $course_ids = PaymentDetails::where('payment_id', $payment->id)->pluck('course_id')->toArray();

            UsersCourse::where('user_id', auth()->user()->id)->whereIn('course_id',$course_ids)->delete();
            UserCertificate::where('user_id', $payment->user_id)->whereIn('course_id',$course_ids)->delete();

            CartItem::where('user_id', auth()->user()->id)->whereIn('course_id', $course_ids)->forceDelete();
            Cart::where('user_id', auth()->user()->id)->forceDelete();
            $payment->delete();
        }

        return back()->with('message', 'Deleted Successfully');
    }
}
