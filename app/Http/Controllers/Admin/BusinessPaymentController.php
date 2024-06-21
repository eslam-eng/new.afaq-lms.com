<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessPaymentRequest;
use App\Models\BusinessPackage;
use App\Models\BusinessPayment;
use App\Models\Payment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessPaymentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('business_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $businessPayments =  BusinessPayment::with(['package','user']);
        $user = auth()->user()->id;
        $free_pay=BusinessPayment::select('provider')->where('user_id',$user)->where('provider','Free')->first();
        // dd($free_pay);
        $payment_invoices = BusinessPayment::where('user_id', $user)
            // ->where('status_response', 'not like', '% "status":"Failed" %')
            ->orWhere('provider',$free_pay)
            ->where(function ($query) use ($free_pay) {
                $query->where('provider', $free_pay)
                    ->orWhere('status_response', 'not like', '% "status":"Failed" %');

            })
            ->get();
//dd($payment_invoices);
        $businessPackages = BusinessPackage::all();
        $paymethod = Payment::select('provider')->distinct()->groupBy('provider')->get();


        if (request('package_id')) {
            $businessPayments = $businessPayments->where('package_id', request('package_id'));
        }
        if (request('provider')) {
            $businessPayments = $businessPayments->where('provider', request('provider'));
        }
        if (request('status') == "1") {
            $businessPayments = $businessPayments->where('status', "1")  ;
        } elseif (request('status') == "0") {
            $businessPayments = $businessPayments->where('status', "0");
        }
        /** filter date */
        $from = $request->date_from;
        $to = $request->date_to;

        if ($from  && $to) {
            $businessPayments =  $businessPayments->whereBetween('created_at', [$from, $to]);
        }
        $businessPayments = $businessPayments->orderBy('id', 'desc')->get();
        return view('admin.businessPayments.index', compact('businessPayments','businessPackages','paymethod','payment_invoices'));
    }

    public function show(BusinessPayment $businessPayment)
    {
        abort_if(Gate::denies('business_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $businessPayment->load('package');
        return view('admin.businessPayments.show', compact('businessPayment'));
    }

    public function destroy(BusinessPayment $businessPayment)
    {
        abort_if(Gate::denies('business_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessPaymentRequest $request)
    {
        $businessPayments = BusinessPayment::find(request('ids'));

        foreach ($businessPayments as $businessPayment) {
            $businessPayment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
