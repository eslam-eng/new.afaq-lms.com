<?php

namespace App\Http\Controllers\Front\AfaqBusiness;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Blog;
use App\Models\BusinessBanner;
use App\Models\BusinessFeature;
use App\Models\BusinessMedicalType;
use App\Models\BusinessNeed;
use App\Models\BusinessPackage;
use App\Models\BusinessPartner;
use App\Models\BusinessPayment;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\Instructor;
use App\Models\Newsletter;
use App\Models\PaymentMethod;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserCertificate;
use App\Payments\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AfaqBusinessHomeController extends Controller
{
    public function index()
    {
        $Banner = BusinessBanner::get()->first();
        $BusinessNeed = BusinessNeed::with(['media'])->get();
        $BusinessFeature = BusinessFeature::with(['media'])->get();
        $BusinessSlider = BusinessMedicalType::with(['media'])->get();

        $BusinessPartners = BusinessPartner::with(['media'])->get();
        $BusinessPackages = BusinessPackage::take(4)->get();
        $BusinessBlogs = Blog::with(['categories', 'tags', 'media', 'editor'])->where('type', 'Business')->get();
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $testimonials = $this->testimonials();
        $statistics = json_decode(json_encode($this->statistics()));

        return view('frontend.business.pages.home')
            ->with('Banner', $Banner)
            ->with('BusinessSlider', $BusinessSlider)
            ->with('BusinessBlogs', $BusinessBlogs)
            ->with('BusinessNeed', $BusinessNeed)
            ->with('BusinessFeature', $BusinessFeature)
            ->with('BusinessPartners', $BusinessPartners)
            ->with('BusinessPackages', $BusinessPackages)
            ->with('testimonials', $testimonials)
            ->with('statistics', $statistics)
            ->with('ContentCategory', $ContentCategory);
    }

    /**
     *return view('frontend.business.pages.home')
     * ;
     * Testimonial
     */
    public function testimonials()
    {
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'desc')->get();
        //  return $this->toJson(TestimonialsResource::collection($testimonials));
        //           dd($testimonials);

        return $testimonials;
    }

    public function statistics()
    {
        return [
            [
                'statistic_name' => trans('cruds.instructor.title'),
                'statistic_count' => Instructor::count(),
                'satatistic_icon' => asset('afaq\business/imgs/icons8-training-48.png')
            ],
            [
                'statistic_name' => trans('cruds.user.title'),
                'statistic_count' => User::count(),
                'satatistic_icon' => asset('afaq\business/imgs/Path 79144.png')
            ],
            [
                'statistic_name' => trans('global.certificates'),
                'statistic_count' => UserCertificate::count(),
                'satatistic_icon' => asset('afaq\business/imgs/Path 79147.png')
            ],
            [
                'statistic_name' => trans('global.courses'),
                'statistic_count' => Course::count(),
                'satatistic_icon' => asset('afaq\business/imgs/Path 80215.png')

            ],


        ];
    }

    /**
     *
     * Join Us
     */
    public function joinus()
    {
        return view('frontend.joinus');
    }

    public function all_business_blogs()
    {
        $blogs = DB::table('blog_content_category')->select('blog_id')->pluck('blog_id')->toArray();
        $blogs = Blog::with(['categories', 'tags', 'media'])->where('type', 'Business')->orderBy('id', 'DESC')->paginate(10);
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.blogs_list')->with('ContentCategory', $ContentCategory)
            ->with('blogs', $blogs);
    }

    public function about_business()
    {
        //        $blogs = DB::table('blog_content_category')->select('blog_id')->pluck('blog_id')->toArray();
        //        $blogs = Blog::with(['categories', 'tags', 'media'])->where('type','Business')->orderBy('id', 'DESC')->paginate(10);
        $about_bussiness = ContentPage::where('title', 'about_business')->where('type', 'Business')->get();
        return view('frontend.blogs_list')->with('about_bussiness', $about_bussiness);
    }

    public function subscribe(Request $request)
    {
//        $request->validate([
//            'email' => 'email|required|unique:newsletters,email',
//        ]);
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('business-error', ['locale' => app()->getLocale()]);
        } else {
            $newsletter = Newsletter::create([
                'email' => $request->email,
                'type' => 'business',
            ]);
//        return back()->with('message', app()->getLocale() == 'en' ? 'Subscribed successfully' : "تم الاشتراك بنجاح");
            return redirect()->route('business-thanks', ['locale' => app()->getLocale()]);
        }


    }

    /**
     *
     * Package Details inner page
     */
    public function package_details()
    {
        $BusinessPackages = BusinessPackage::take(4)->get();
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.business.partials.package_details')
            ->with('BusinessPackages', $BusinessPackages)
            ->with('ContentCategory', $ContentCategory);
    }

    /**
     * Package Details
     */

    public function own_package()
    {
        $BusinessPackages = BusinessPackage::take('4')->get();
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.business.partials.own_package')
            ->with('BusinessPackages', $BusinessPackages)
            ->with('ContentCategory', $ContentCategory);
    }

    public function thanks()
    {
        return view('frontend.business.pages.thanks-page');
    }

    public function warning()
    {
        return view('frontend.business.pages.warning-page');
    }

    public function business_error()
    {
        return view('frontend.business.pages.error-page');
    }

    public function BusinessContactUs()
    {
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.business.pages.BusinessContactUs')->with('ContentCategory', $ContentCategory);
    }

    public function businessEnquiry(StoreEnquiryRequest $request)
    {

        $all_request = $request->all();
        $details = [
            'name' => $all_request['name'],
            'email' => $all_request['email'],
            'message' => $all_request['message'],
            'mobile' => $all_request['mobile'],
            'type' => 'business',
        ];
//        try {
        //

//            Mail::to($all_request['email'])->send(new \App\Mail\ContactMail($details));
//            Mail::to(config('app.email'))->send(new \App\Mail\ContactMail($details));
//        } catch (\Throwable $th) {
//            // throw $th;
//        }

        $enquiry = Enquiry::create($details);
        return back()->withSuccess('Your data has been sent successfully. We will contact you shortly.');
    }

    /**
     *
     * Package Payment
     */
    public function business_payment(Request $request)
    {
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $type = $request->type;
        $payment_methods = [];
        if (auth()->check()) {
            $user = auth()->user();
            $user_package = BusinessPayment::where('user_id', $user->id)
                ->where('status', 1)->get();

            if ($user_package->count() > 0) {

                return redirect()->route('business-warning', ['locale' => app()->getLocale()]);
            } else
                if (request('package_id')) {
                    $package_id = request('package_id');
                    $package = BusinessPackage::where('id', $package_id)->first();

                    if (isset($package->package_month_price_offers)) {
                        $amount = ($request->type && $request->type == 'month') ? $package->package_month_price_offers : (($request->type && $request->type == 'year') ? $package->package_annual_price_offers : 0);
                    } else {

                        $amount = ($request->type && $request->type == 'month') ? $package->price_package_month : (($request->type && $request->type == 'year') ? $package->price_package_annual : 0);
                    }
                    if ($amount == "0") {
                        $this->freePayment($request);

                        return redirect()->route('business-thanks', ['locale' => app()->getLocale(), 'type' => "Free", 'package_id' => $package_id]);
                    }

                    $payment_methods = PaymentMethod::where('status', 1)->where('type', 'api')->where('provider', '!=', 'Bank')->orderBy('order', 'asc')->get();
                   //we add amount in compact
                    return view('frontend.business.partials.business_payment', compact('package', 'payment_methods', 'ContentCategory', 'type','amount'));
                }
        }
        return back();
    }

    /****
     *
     *
     * Business Checkout
     */

    public function business_checkout(Request $request, $lang, $package_id, $user_id = null)
    {
        $payment_method = ($user_id) ? 7 : ($request->payment_method ?? 4); // 4 is ID of Bank Method ;
        if ($payment_method === null) {
            return back()->with('message', app()->getLocale() == 'en' ? 'Please ,Choose The Payment Method' : 'من فضلك اختر طريقه الدفع');
        }

        $user = ($user_id) ? User::where('id', $user_id)->first() : auth()->user();

        $paymentGateway = Factory::make($payment_method);
        $package = BusinessPackage::where('id', $package_id)->first();

        if (isset($package->package_month_price_offers)) {
            $amount = ($request->type && $request->type == 'month') ? $package->package_month_price_offers : (($request->type && $request->type == 'year') ? $package->package_annual_price_offers : 0);

        } else {
            $amount = ($request->type && $request->type == 'month') ? $package->price_package_month : (($request->type && $request->type == 'year') ? $package->price_package_annual : 0);

        }
        if (request('payment_id')) {

            $data = [
                'amount' => $amount ?? 0,
                'method_id' => $paymentGateway->method_id,
                'payment_id' => request('payment_id')
            ];
        } else {

            $data = [
                'amount' => $amount ?? 0,
                'method_id' => $paymentGateway->method_id,
                'package_id' => $package_id,
                'type' => $request->type
            ];
        }

        $payment = $paymentGateway->pay($data);
        if (isset($payment['PaymentURL'])) {

            if ($paymentGateway->name == "Bank") {
                $package = BusinessPackage::where('id', $request->package_id)->latest()->first();

                $payment_item = BusinessPayment::firstOrCreate(
                    [
                        'provider' => $paymentGateway->name,
                        'payment_number' => $payment['InvoiceId'],
                    ],
                    [
                        // Package details saved
                        'package_id' => $package->id,
                        'package_name_en' => $package->package_name_en,
                        'package_name_ar' => $package->package_name_ar ?? '',
                        'price_package_annual' => $package->price_package_annual ?? '',
                        'package_annual_price_offers' => $package->package_annual_price_offers ?? '',
                        'price_package_month' => $amount ?? '',
                        'package_month_price_offers' => $amount ?? '',
                        'event_number' => $package->event_number ?? '',
                        'speakers_number' => $package->speakers_number ?? '',
//                        'attendance_trainees_number'=>$package->attendance_trainees_number ?? '',
//                        'remote_trainees_number'=>$package->remote_trainees_number ?? '',
//                        'electronic_registration_system'=>$package->electronic_registration_system ?? '',
//                        'e_certificate'=>$package->e_certificate ?? '',
//                        'customize_event_with_host_identity'=>$package->customize_event_with_host_identity ?? '',
//                        'digital_marketing_event'=>$package->digital_marketing_event ?? '',
//                        'advertising_afaq_core'=>$package->advertising_afaq_core ?? '',
//                        'quality_control_inquiries'=>$package->quality_control_inquiries ?? '',
//                        'help_center_customer_response'=>$package->help_center_customer_response ?? '',
//                        'technical_support'=>$package->technical_support ?? '',
//                        'event_accreditation'=>$package->event_accreditation ?? '',
//                        'event_free_collection'=>$package->event_free_collection ?? '',
//                        'e_certificate_speaker'=>$package->e_certificate_speaker ?? '',
//                        'two_email_trainees'=>$package->two_email_trainees ?? '',
//                        'target_groups_mails'=>$package->target_groups_mails ?? '',
//                        'electronic_testing_system'=>$package->electronic_testing_system ?? '',
//                        'effectiveness_rating_system'=>$package->effectiveness_rating_system ?? '',
//                        'discount_free_coupon'=>$package->discount_free_coupon ?? '',
//                        'event_reports'=>$package->event_reports ?? '',
//                        'attendance_absence_qr_system'=>$package->attendance_absence_qr_system ?? '',
//                        'printable_id_card'=>$package->printable_id_card ?? '',
//                        'conference_workshops_attendance'=>$package->conference_workshops_attendance ?? '',
//                        'send_messages_event_participants'=>$package->send_messages_event_participants ?? '',
//                        'event_notification_mobile'=>$package->event_notification_mobile ?? '',
//                        'fixed_advertising_banner'=>$package->fixed_advertising_banner ?? '',
//                        'responsible_employee_manage_event'=>$package->responsible_employee_manage_event ?? '',
//                        'event_number_days'=>$package->event_number_days ?? '',
                        'online' => $package->online ?? '',
                        'hybrid' => $package->hybrid ?? '',
                        'onsite' => $package->onsite ?? '',
                        // end of package details


                        'payment_method_id' => $paymentGateway->method_id,
                        'provider' => $paymentGateway->name,
                        'payment_number' => $payment['InvoiceId'],
                        'user_id' => $user->id,
                        'price' => $amount,
                        'status' => 0,
                        'initial_response' => isset($payment['response']) ? $payment['response'] : null,

                    ]
                );
            }


            return redirect($payment['PaymentURL']);
        } else {
            dd('there is no payment url');
        }
    }

    /**
     *
     * Business checkout Complete
     */
    public function business_checkout_complete(Request $request)
    {

        $response_msg = 'some thing wrong in payment process ,try again or contact with AFAQ admin.';
        try {
            DB::beginTransaction();
            $paymentGateway = Factory::make($request->payment_method_id);
            $response = $paymentGateway->getPaymentStatus($paymentGateway->name == "Hyber" ? $request->resourcePath : $request->paymentId);

            $user = isset($response['user_id']) ? User::where('id', $response['user_id'])->first() : auth()->user();

            if (isset($response['status'])) {
                $package = BusinessPackage::where('id', $request->package_id)->latest()->first();

                $amount = $package->price_package_month;

                if (isset($package->package_month_price_offers)) {
                    $amount = $package->package_month_price_offers;
                } else {
                    $amount = $package->price_package_month;
                }

                $payment_item = BusinessPayment::firstOrCreate(
                    [
                        'provider' => $paymentGateway->name,
                        'payment_number' => $response['invoice_id'],
                    ],
                    [
                        // Package details saved
                        'package_id' => $package->id,
                        'package_name_en' => $package->package_name_en,
                        'package_name_ar' => $package->package_name_ar ?? '',
                        'price_package_annual' => $package->price_package_annual ?? '',
                        'package_annual_price_offers' => $package->package_annual_price_offers ?? '',
                        'price_package_month' => $amount ?? '',
                        'package_month_price_offers' => $amount ?? '',
                        'event_number' => $package->event_number ?? '',
                        'speakers_number' => $package->speakers_number ?? '',
//                        'attendance_trainees_number'=>$package->attendance_trainees_number ?? '',
//                        'remote_trainees_number'=>$package->remote_trainees_number ?? '',
//                        'electronic_registration_system'=>$package->electronic_registration_system ?? '',
//                        'e_certificate'=>$package->e_certificate ?? '',
//                        'customize_event_with_host_identity'=>$package->customize_event_with_host_identity ?? '',
//                        'digital_marketing_event'=>$package->digital_marketing_event ?? '',
//                        'advertising_afaq_core'=>$package->advertising_afaq_core ?? '',
//                        'quality_control_inquiries'=>$package->quality_control_inquiries ?? '',
//                        'help_center_customer_response'=>$package->help_center_customer_response ?? '',
//                        'technical_support'=>$package->technical_support ?? '',
//                        'event_accreditation'=>$package->event_accreditation ?? '',
//                        'event_free_collection'=>$package->event_free_collection ?? '',
//                        'e_certificate_speaker'=>$package->e_certificate_speaker ?? '',
//                        'two_email_trainees'=>$package->two_email_trainees ?? '',
//                        'target_groups_mails'=>$package->target_groups_mails ?? '',
//                        'electronic_testing_system'=>$package->electronic_testing_system ?? '',
//                        'effectiveness_rating_system'=>$package->effectiveness_rating_system ?? '',
//                        'discount_free_coupon'=>$package->discount_free_coupon ?? '',
//                        'event_reports'=>$package->event_reports ?? '',
//                        'attendance_absence_qr_system'=>$package->attendance_absence_qr_system ?? '',
//                        'printable_id_card'=>$package->printable_id_card ?? '',
//                        'conference_workshops_attendance'=>$package->conference_workshops_attendance ?? '',
//                        'send_messages_event_participants'=>$package->send_messages_event_participants ?? '',
//                        'event_notification_mobile'=>$package->event_notification_mobile ?? '',
//                        'fixed_advertising_banner'=>$package->fixed_advertising_banner ?? '',
//                        'responsible_employee_manage_event'=>$package->responsible_employee_manage_event ?? '',
//                        'event_number_days'=>$package->event_number_days ?? '',
                        'online' => $package->online ?? '',
                        'hybrid' => $package->hybrid ?? '',
                        'onsite' => $package->onsite ?? '',
                        // end of package details

                        'payment_method_id' => $paymentGateway->method_id,
                        'provider' => $paymentGateway->name,
                        'payment_number' => $response['invoice_id'],
                        'user_id' => $user->id,
                        'price' => $amount,
                        'status' => 0,
                        'initial_response' => isset($payment['response']) ? $payment['response'] : null,

                    ]
                );

                $payment = BusinessPayment::where('payment_number', $response['invoice_id'])->where('status', 0)->first();
                if ($payment) {

                    if (request('payment_id')) {
                        $payment_id = request('payment_id');
                        $package = BusinessPackage::where('id', $request->package_id)->latest()->first();
                    } else {
                        $cart = BusinessPackage::where('id', $request->package_id)->latest()->first();

                        $payment_id = $response['invoice_id'];
                    }

                    if (isset($paymentGateway) && $paymentGateway->name != 'Bank') {
                        if ($response['status'] == 'Paid') {
                            if (request('payment_id')) {
                                BusinessPayment::where('payment_number', $payment_id)->delete();

                                $payment = BusinessPayment::where('payment_number', $response['invoice_id'])->first();
                                $payment->update(['status' => 1, 'approved' => 1, 'invoice_number' => BusinessPayment::whereNull('deleted_at')->where('approved', 1)->count() + 1]);
                            } else {

                                BusinessPayment::where('payment_number', $response['invoice_id'])->update(['status' => 1]);
                            }
                        }
                    }
                }

                try {
                    $payment = BusinessPayment::where('payment_number', $response['invoice_id'])->first();
                    $payment->status_response = json_encode($response);
                    if ($response['status'] == 'Paid' && $payment->provider != 'Bank') {
                        $payment->invoice_number = BusinessPayment::whereNull('deleted_at')->where('status', 1)->count() + 1;
                    }

                    $payment->save();
                } catch (\Throwable $th) {
                    // throw $th;
                }
                DB::commit();
                if ($payment->status == '1') {
                    return redirect()->route('business-thanks', ['locale' => app()->getLocale(), 'package_id' => $package->id]);
                } elseif ($payment->status == '0') {
                    return redirect()->route('business-error', ['locale' => app()->getLocale()]);

                }
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

    public function pageContent($lang, $slug)
    {
        $page_content = null;
        $pages = ContentPage::get();
        foreach ($pages as $page) {
            if (Str::slug($page->title) == Str::slug($slug)) {
                $page_content = $page;
                break;
            } else {
                $page_content = ContentPage::first();
            }
        }

        $ContentCategory = ContentCategory::where('type', 'Business')->get();

        return view('frontend.business.pages.BusinessContent')->with('slug', $slug)
            ->with('page_content', $page_content)
            ->with('ContentCategory', $ContentCategory);
    }

    public function free(Request $request, $package_id)
    {
        $user_id = auth()->user()->id;
        $payment_method = ($user_id) ? 7 : ($request->payment_method ?? 4); // 4 is ID of Bank Method ;
        if ($payment_method === null) {
            return back()->with('message', app()->getLocale() == 'en' ? 'Please ,Choose The Payment Method' : 'من فضلك اختر طريقه الدفع');
        }

        $user = ($user_id) ? User::where('id', $user_id)->first() : auth()->user();

        $paymentGateway = Factory::make($payment_method);
        $package = BusinessPackage::where('id', $package_id)->first();



        if(isset($package->package_month_price_offers)) {
            $amount = $package->package_month_price_offers;
        } else {
            $amount = $package->price_package_month;
        }

        if (request('payment_id')) {

            $data = [
                'amount' => $amount ?? 0,
                'method_id' => $paymentGateway->method_id,
                'payment_id' => request('payment_id')
            ];
        } else {

            $data = [
                'amount' => $amount ?? 0,
                'method_id' => $paymentGateway->method_id,
                'package_id' => $package_id
            ];
        }


        $payment = $paymentGateway->pay($data);
        if (isset($payment['PaymentURL'])) {

            if ($paymentGateway->name == "Bank") {
                $package = BusinessPackage::where('id', $request->package_id)->latest()->first();

                $payment_item = BusinessPayment::firstOrCreate(
                    [
                        'provider' => $paymentGateway->name,
                        'payment_number' => $payment['InvoiceId'],
                    ],
                    [
                        // Package details saved
                        'package_id' => $package->id,
                        'package_name_en' => $package->package_name_en,
                        'package_name_ar' => $package->package_name_ar ?? '',
                        'price_package_annual' => $package->price_package_annual ?? '',
                        'package_annual_price_offers' => $package->package_annual_price_offers ?? '',
                        'price_package_month' => $amount ?? '',
                        'package_month_price_offers' => $package->package_month_price_offers ?? '',
                        'event_number' => $package->event_number ?? '',
                        'speakers_number' => $package->speakers_number ?? '',
                        'attendance_trainees_number' => $package->attendance_trainees_number ?? '',
                        'remote_trainees_number' => $package->remote_trainees_number ?? '',
                        'electronic_registration_system' => $package->electronic_registration_system ?? '',
                        'e_certificate' => $package->e_certificate ?? '',
                        'customize_event_with_host_identity' => $package->customize_event_with_host_identity ?? '',
                        'digital_marketing_event' => $package->digital_marketing_event ?? '',
                        'advertising_afaq_core' => $package->advertising_afaq_core ?? '',
                        'quality_control_inquiries' => $package->quality_control_inquiries ?? '',
                        'help_center_customer_response' => $package->help_center_customer_response ?? '',
                        'technical_support' => $package->technical_support ?? '',
                        'event_accreditation' => $package->event_accreditation ?? '',
                        'event_free_collection' => $package->event_free_collection ?? '',
                        'e_certificate_speaker' => $package->e_certificate_speaker ?? '',
                        'two_email_trainees' => $package->two_email_trainees ?? '',
                        'target_groups_mails' => $package->target_groups_mails ?? '',
                        'electronic_testing_system' => $package->electronic_testing_system ?? '',
                        'effectiveness_rating_system' => $package->effectiveness_rating_system ?? '',
                        'discount_free_coupon' => $package->discount_free_coupon ?? '',
                        'event_reports' => $package->event_reports ?? '',
                        'attendance_absence_qr_system' => $package->attendance_absence_qr_system ?? '',
                        'printable_id_card' => $package->printable_id_card ?? '',
                        'conference_workshops_attendance' => $package->conference_workshops_attendance ?? '',
                        'send_messages_event_participants' => $package->send_messages_event_participants ?? '',
                        'event_notification_mobile' => $package->event_notification_mobile ?? '',
                        'fixed_advertising_banner' => $package->fixed_advertising_banner ?? '',
                        'responsible_employee_manage_event' => $package->responsible_employee_manage_event ?? '',
                        'event_number_days' => $package->event_number_days ?? '',
                        'online' => $package->online ?? '',
                        'hybrid' => $package->hybrid ?? '',
                        'onsite' => $package->onsite ?? '',
                        // end of package details

                        'payment_method_id' => $paymentGateway->method_id,
                        'provider' => $paymentGateway->name,
                        'payment_number' => $payment['InvoiceId'],
                        'user_id' => $user->id,
                        'price' => $amount,
                        'status' => 0,
                        'initial_response' => isset($payment['response']) ? $payment['response'] : null,

                    ]
                );
            }


            return redirect($payment['PaymentURL']);
        } else {
            dd('there is no payment url');
        }
    }

    public function freePayment(Request $request)
    {
        $package = BusinessPackage::where('id', $request->package_id)->latest()->first();

        if (isset($package->package_month_price_offers)) {
            $amount = $package->package_month_price_offers;
        } else {
            $amount = $package->price_package_month;
        }


        $user = auth()->user();
        $invoice_id = time() . rand(0, 1000);
        $payment_item = BusinessPayment::firstOrCreate(
            [
                'provider' => 'Free',
                'payment_number' => $invoice_id,
            ],
            [
                // Package details saved
                'package_id' => $package->id,
                'package_name_en' => $package->package_name_en,
                'package_name_ar' => $package->package_name_ar ?? '',
                'price_package_annual' => $package->price_package_annual ?? '',
                'package_annual_price_offers' => $package->package_annual_price_offers ?? '',
                'price_package_month' => $amount ?? '',
                'package_month_price_offers' => $package->package_month_price_offers ?? '',
                'event_number' => $package->event_number ?? '',
                'speakers_number' => $package->speakers_number ?? '',
                'attendance_trainees_number' => $package->attendance_trainees_number ?? '',
                'remote_trainees_number' => $package->remote_trainees_number ?? '',
                'electronic_registration_system' => $package->electronic_registration_system ?? '',
                'e_certificate' => $package->e_certificate ?? '',
                'customize_event_with_host_identity' => $package->customize_event_with_host_identity ?? '',
                'digital_marketing_event' => $package->digital_marketing_event ?? '',
                'advertising_afaq_core' => $package->advertising_afaq_core ?? '',
                'quality_control_inquiries' => $package->quality_control_inquiries ?? '',
                'help_center_customer_response' => $package->help_center_customer_response ?? '',
                'technical_support' => $package->technical_support ?? '',
                'event_accreditation' => $package->event_accreditation ?? '',
                'event_free_collection' => $package->event_free_collection ?? '',
                'e_certificate_speaker' => $package->e_certificate_speaker ?? '',
                'two_email_trainees' => $package->two_email_trainees ?? '',
                'target_groups_mails' => $package->target_groups_mails ?? '',
                'electronic_testing_system' => $package->electronic_testing_system ?? '',
                'effectiveness_rating_system' => $package->effectiveness_rating_system ?? '',
                'discount_free_coupon' => $package->discount_free_coupon ?? '',
                'event_reports' => $package->event_reports ?? '',
                'attendance_absence_qr_system' => $package->attendance_absence_qr_system ?? '',
                'printable_id_card' => $package->printable_id_card ?? '',
                'conference_workshops_attendance' => $package->conference_workshops_attendance ?? '',
                'send_messages_event_participants' => $package->send_messages_event_participants ?? '',
                'event_notification_mobile' => $package->event_notification_mobile ?? '',
                'fixed_advertising_banner' => $package->fixed_advertising_banner ?? '',
                'responsible_employee_manage_event' => $package->responsible_employee_manage_event ?? '',
                'event_number_days' => $package->event_number_days ?? '',
                'online' => $package->online ?? '',
                'hybrid' => $package->hybrid ?? '',
                'onsite' => $package->onsite ?? '',
                // end of package details

                'payment_method_id' => 12,
                'provider' => 'Free',
                'payment_number' => $invoice_id,
                'user_id' => $user->id,
                'price' => $amount,
                'status' => 0,
                'initial_response' => isset($payment['response']) ? $payment['response'] : null,

            ]
        );

        $payment = BusinessPayment::where('payment_number', $invoice_id)->where('status', 0)->first();
        if ($payment) {
            BusinessPayment::where('payment_number', $invoice_id)->update(['status' => 1]);
        }

        try {
            $payment = BusinessPayment::where('payment_number', $invoice_id)->first();
            $payment->status_response = null;
            $payment->invoice_number = BusinessPayment::whereNull('deleted_at')->where('status', 1)->count() + 1;


            $payment->save();
        } catch (\Throwable $th) {
            // throw $th;
        }
        DB::commit();

        return true;
    }
}
