<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\SendFirstAfterPaymentEmailNotification;
use App\Notifications\SendPaymentEmailNotification;
use App\Notifications\SendSecondAfterPaymentEmailNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payments = Payment::where('payment_type', 1)->orWhere('payment_type', null)->get();

        $users = User::get();

        return view('admin.payments.index', compact('payments', 'users'));
    }


    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('user');

        return view('admin.payments.show', compact('payment'));
    }

    public function add(Request $request)
    {
        //dd($request->resultIndicator);
        $updated = false;
        if (isset($request->resultIndicator)) {
            $updated = Payment::where('sessionIndicator', $request->resultIndicator)->update(['status' => 'Captured']);
            $users = User::find(Auth::user()->id);
            try {
                //code...
                Notification::send($users, new SendPaymentEmailNotification($users));
                Notification::send($users, new SendFirstAfterPaymentEmailNotification($users));
                Notification::send($users, new SendSecondAfterPaymentEmailNotification($users));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        return redirect()->route('admin.home', compact('updated'));
    }

    public function cancel()
    {
        $lasttransaction =  Payment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        // dd($lasttransaction->toArray());
        // $lasttransaction->update(['status'=>'canceled']);
        return redirect()->route('admin.home');
    }
    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payments.create', compact('users'));
    }

    //
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());

        return redirect()->route('admin.payments.index');
    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment->load('user');

        return view('admin.payments.edit', compact('users', 'payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('admin.payments.index');
    }
    public function error(Request $request)
    {
        $lasttransaction =  Payment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        // dd($lasttransaction->toArray());
        $lasttransaction->update(['status' => json_encode($request->all())]);
        return redirect()->route('admin.home');
    }
}
