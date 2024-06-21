<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCancelPaymentRequest;
use App\Http\Requests\StoreCancelPaymentRequest;
use App\Http\Requests\UpdateCancelPaymentRequest;
use App\Models\BankInvoice;
use App\Models\CancelPayment;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\UsersCourse;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CancelPaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cancel_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelPayments = CancelPayment::with(['user'])->get();

        return view('admin.cancelPayments.index', compact('cancelPayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('cancel_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cancelPayments.create');
    }

    public function store(StoreCancelPaymentRequest $request)
    {

        $cancelPayment = CancelPayment::create([
            'payment_id' => $request->payment_id,
            'invoice_id' => $request->invoice_id,
            'user_id' => $request->user_id,
            'status' => 0,
            'approved' => 0,
        ]);
        //  return redirect()->route('admin.cancel-payments.index');
        return back()->with('message', __('global.request_sent_success'));
    }



    public function show(CancelPayment $cancelPayment)
    {
        abort_if(Gate::denies('cancel_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cancelPayment->load('user');
        return view('admin.cancelPayments.show', compact('cancelPayment'));
    }

    public function destroy(CancelPayment $cancelPayment)
    {
        abort_if(Gate::denies('cancel_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelPayment->delete();

        return back();
    }


    public function DeleteCourseReservation(Request $request)
    {

        $cancelPayment = Payment::find($request->payment_id);

        if ($cancelPayment) {
            Payment::where('id', $cancelPayment->payment_id)->delete();
            $payment_detials = PaymentDetails::where('payment_id', $cancelPayment->payment_id)->pluck('course_id')->toArray();
            Enroll::where('payment_id', $cancelPayment->payment_id)->delete();
            BankInvoice::where('invoice_id', $cancelPayment->payment_number)->delete();
            UsersCourse::where(['user_id', $cancelPayment->user_id, 'course_id' => $payment_detials])->delete();
            CancelPayment::where('approved', $cancelPayment->approved)->update(['approved' => 1]);
            PaymentDetails::where('payment_id', $cancelPayment->payment_id)->delete();

            // $user = auth()->user();
            // $data =[
            //     'user_id' => $user->id,
            //     'message' => __('global.Cancelled_successfully'),
            //     'title_en' => 'Cancelled_successfully',
            //     'title_ar' => 'Cancelled_successfully',
            //     'message_en' => 'Cancelled_successfully',
            //     'message_ar' => 'Cancelled_successfully',
            //     'type' => 'course',
            //     'parent_id' => null,
            // ];
    
            // event(new \App\Events\PopUserNotification($data));
            // $user->notify( new \App\Notifications\RealTimeNotification($data));

            return back()->with('message', __('global.Cancelled_successfully'));
        }

        //        if ($cancelPayment->approved == 1) {
        //            Notification::send($users, new ApprovePaymentNotification($reservation));
        //        }
        //        return response()->json(['error' => 'Cancelled Errors ']);
        return back()->with('errors', $cancelPayment);
    }
}
