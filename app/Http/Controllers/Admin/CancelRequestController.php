<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCancelRequestRequest;
use App\Models\BankInvoice;
use App\Models\CancelRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\User;
use App\Models\UsersCourse;
use App\Models\Wallet;
use App\Notifications\ApprovePaymentNotification;
use App\Notifications\CancelPaymentRequestNotification;
use App\Notifications\RejectedCancelRequestNotification;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class CancelRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cancel_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelRequests = CancelRequest::with(['course', 'user','payment'])->get();
        if (request('refound_type')) {
            $cancelRequests = $cancelRequests->where('type', request('refound_type'));

        }

        return view('admin.cancelRequests.index', compact('cancelRequests'));
    }

    public function show(CancelRequest $cancelRequest)
    {
        abort_if(Gate::denies('cancel_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelRequest->load('course', 'user');

        return view('admin.cancelRequests.show', compact('cancelRequest'));
    }

    public function destroy(CancelRequest $cancelRequest)
    {
//        abort_if(Gate::denies('cancel_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::where('id', $cancelRequest->user_id)->get();

        $cancelRequest->update([
            'rejected' => 1
        ]);
        try {
            //code...
            Notification::send($user, new RejectedCancelRequestNotification($cancelRequest));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return back();
    }

    public function massDestroy(MassDestroyCancelRequestRequest $request)
    {
        CancelRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function verify(Request $request)
    {
        $data = $request->all();
        $cancel_request = CancelRequest::find($request->cancel_request_id);
        $user=User::where('id', $cancel_request->user_id)->get();

        if ($cancel_request) {
//            dd($request);
            $payment_detail['refound_type'] = $data['refound_type'];
            $payment_detail['status'] = 0;
            $payment_detail['refound_amount'] = $data['refound_amount'];
            $payment_detial['cancel_reason'] = $cancel_request->cancel_reason;
            $payment_detail['deleted_at'] = Carbon::now();
            $pay_det = PaymentDetails::where('course_id', $cancel_request->course_id)->where('user_id', $cancel_request->user_id)->where('status', 1)->first();
            Enroll::where('payment_id', $pay_det->payment_id)->where('course_id', $cancel_request->course_id)->update([
                'status' => 0,
                'approved' => 0,
                'deleted_at' => Carbon::now()
            ]);

            UsersCourse::where('course_id', $pay_det->course_id)->where('user_id', $pay_det->user_id)->delete();

            $pay_det->update($payment_detail);
            $refound_amount = (float) $data['refound_amount'];
            $total_canceled = $pay_det->final_price;
            $payment = Payment::find($pay_det->payment_id);

            if ($payment) {
                $payment->update([
                    'refound_amount' => $refound_amount ??  null,
                    'refound_type' => $refound_amount > 0 ? $data['refound_type'] : null,
                    'amount'  => $payment->amount - $refound_amount
                ]);
            }

            if (isset($data['refound_type']) && $data['refound_type'] == 'wallet') {
                $user_wallet = Wallet::where('user_id', $cancel_request->user_id)->first();
                if ($user_wallet) {
                    $user_wallet->update([
                        'balance' => $user_wallet->balance + $refound_amount
                    ]);
                } else {
                    Wallet::create([
                        'user_id' => $cancel_request->user_id,
                        'currency' => 'SAR',
                        'balance' => $refound_amount,
                        'status' => 1,
                    ]);
                }
            }

            if (!$payment->payment_details->count()) {
                $payment->update([
                    'deleted_at' => Carbon::now()
                ]);

                BankInvoice::where('invoice_id',$payment->payment_number)->delete();
            }

            $cancel_request->update([
                'approved' => 1,
                'type'=> $data['refound_type']
            ]);
            CartItem::where('user_id', $cancel_request->user_id)->where('course_id', $pay_det->course_id)->delete();

            Cart::where('user_id', $cancel_request->user_id)->delete();

            try {
                //code...
                Notification::send($user, new CancelPaymentRequestNotification($data,$cancel_request));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return redirect(action('Admin\CancelRequestController@index'));
    }
}
