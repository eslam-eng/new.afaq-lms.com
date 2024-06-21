<?php

namespace App\Http\Controllers\Front\AfaqBusiness;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessSpecialRequestRequest;
use App\Models\BusinessEventType;
use App\Models\BusinessPayment;
use App\Models\BusinessSpecialRequest;
use App\Models\ContentCategory;
use App\Models\Country;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BusinessProfileController extends Controller
{
    /**
     *
     *
     */
    public function businessProfile()
    {
       if (!auth()->check())
        {
        return redirect('/new_login');
        }
       else {

        $data = auth()->user();
        $user = auth()->user()->id;

        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $package_payment=BusinessPayment::where('user_id', $user)
            ->where('status',1)->get();
            $payment_invoices = BusinessPayment::where('status_response', 'not like', '% "status":"Failed" %')
            ->orWhere('status_response', null)
            ->where('user_id', $user)->get();
        $tickets = Ticket::where('user_id', $user)
            ->where('type','Business')->get();
        $categories = TicketCategory::where('status', 1)
            ->where('type','Business')->get();
        return view('frontend.business.pages.account-setting')
//
            ->with('ContentCategory', $ContentCategory)
            ->with('data',$data)
            ->with('package_payment',$package_payment)
            ->with('payment_invoices',$payment_invoices)
            ->with('tickets', $tickets)
            ->with('categories', $categories);
//            compact('package_payment', 'payment_invoices', 'data' ,'ContentCategory','tickets','categories'));
       }
    }



    public function business_packages()
    {
        if (!auth()->check())
        {
            return redirect('/new_login');
        }
        else {
            $data = auth()->user();
            $user = auth()->user()->id;
            $ContentCategory = ContentCategory::where('type', 'Business')->get();
            $package_payment=BusinessPayment::where('user_id', $user)
                ->where('status',1)->get();
            $payment_invoices = BusinessPayment::where('status_response', 'not like', '% "status":"Failed" %')
                ->orWhere('status_response', null)
                ->where('user_id', $user)->get();
            $tickets = Ticket::where('user_id', $user)
                ->where('type','Business')->get();
            $categories = TicketCategory::where('status', 1)
                ->where('type','Business')->get();
            return view('frontend.business.pages.accountSetting-package')
                ->with('ContentCategory', $ContentCategory)
                ->with('data',$data)
                ->with('package_payment',$package_payment)
                ->with('payment_invoices',$payment_invoices)
                ->with('tickets', $tickets)
                ->with('categories', $categories);
        }
    }

    public function business_invoices()
    {
        if (!auth()->check())
        {
            return redirect('/new_login');
        }
        else {
            $data = auth()->user();
            $user = auth()->user()->id;

            $ContentCategory = ContentCategory::where('type', 'Business')->get();
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

            return view('frontend.business.pages.accountSetting-Invoices')

                ->with('ContentCategory', $ContentCategory)
                ->with('data',$data)
                ->with('payment_invoices',$payment_invoices);

        }
    }
    public function business_tickets()
    {
        if (!auth()->check())
        {
            return redirect('/new_login');
        }
        else {
            $data = auth()->user();

            $user = auth()->user()->id;


            $ContentCategory = ContentCategory::where('type', 'Business')->get();

            $tickets = Ticket::where('user_id', $user)
                ->where('type','Business')->get();
            $categories = TicketCategory::where('status', 1)
                ->where('type','Business')->get();
            return view('frontend.business.pages.accountSetting-Tickets')
//
                ->with('ContentCategory', $ContentCategory)
                ->with('data',$data)
                ->with('tickets', $tickets)
                ->with('categories', $categories);
//            compact('package_payment', 'payment_invoices', 'data' ,'ContentCategory','tickets','categories'));
        }
    }

    /** Invoice Print
     *
     *
     */
    public function print_business_Invoice(Request $request,$lang,$payment_id)
    {

        $payment = null;
        try {
            $payment = BusinessPayment::where('id', $payment_id)->with('package', 'user')->first();

            //where('user_id', auth()->user()->id)->
//            if (!$payment->qr_image) {
//                $qrcode = \QrCode::size(155)->generate(route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $payment_id]));
//                $payment->update(['qr_image' => $qrcode]);
//            }

            if (!$payment->qr_image) {
                $qrcode = \QrCode::format("png")->size(200)->generate((route('business_invoice.print', ['locale' => app()->getLocale(),

                    'package_id' => $payment->package_id,
                    'PackageName' =>$payment->package->package_name_en,
                    'UserName' =>$payment->user->full_name_en,
                    'user_id' => $payment->user_id,
                    'payment_id' => $payment->id,

                ])));
                $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                $payment->qr_image = $qr_img;
                $payment->update(['qr_image' => $qrcode]);
            }




        } catch (\Throwable $th) {
            throw $th;
        }
        return view('frontend.business.pages.business_invoice', compact('payment'));
    }


    /**
     * Tickets
     */
    public function create_tickets(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'       => 'required',
            'user_id' => 'required',
            'ticket_category_id'       => 'required',
            'email'  => 'required|email',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',

        ]);
        $data = $request->all();

        if (isset($data['image'])) {

            $data['image'] = $data['image']->store('business-ticket-image', 'public');

        }
        $ticket = Ticket::create($data);

        //        return redirect()->back()->withStatus('Your ticket has been submitted, we will be in touch. You can view ticket status
        //        ');
        //        <a href="'.route('tickets.show', $ticket->id).'">here</a>
        return back()->with('message', app()->getLocale() == 'en' ? 'Your ticket has been submitted, we will be in touch.' : 'تم حفظ بيانات لتذكرة بنجاح');
    }
    /**
     *
     * customize now
     */
    public function customize_now()
    {
        //$specializations = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $event_types = BusinessEventType::where('status',1)->pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('frontend.business.pages.business_special_request',compact('ContentCategory','event_types'));
//        return view('frontend.business.pages.business_special_request');
    }
    /**
     * Business Special_Request
     */
    public function business_special_request(StoreBusinessSpecialRequestRequest $request)
    {

        $all_request = $request->all();
        if (is_array($all_request['phone_number'])) {
            $all_request['phone_number'] = $all_request['phone_number']['full_number'] ?? isset($all_request['phone_number']['full']);
        }
        $details = [
            'event_type_id' => $all_request['event_type_id'],
            'number_of_attendees' => $all_request['number_of_attendees'],
            'event_starting_date' => $all_request['event_starting_date'],
            'details' => $all_request['details'],
            'full_name' => $all_request['full_name'],
            'email_address' => $all_request['email_address'],
            'employer' => $all_request['employer'],
            'job_title' => $all_request['job_title'],
            'phone_number' => $all_request['phone_number'],
            'accept_terms' => $all_request['accept_terms'],
        ];
        try {
            Mail::to($all_request['email_address'])->send(new \App\Mail\ContactMail($details));
            Mail::to(config('app.email'))->send(new \App\Mail\ContactMail($details));
        } catch (\Throwable $th) {
            // throw $th;
        }

        $businessSpecialRequests = BusinessSpecialRequest::create($details);
        return redirect()->route('business-thanks', ['locale' => app()->getLocale()]);

    }

}
