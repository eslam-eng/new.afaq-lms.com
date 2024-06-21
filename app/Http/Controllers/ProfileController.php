<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\PointResource;
use App\Models\CancelationPolicy;
use App\Models\CancelRequest;
use App\Models\ContentCategory;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseQuizeScore;
use App\Models\Exam;
use App\Models\Point;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\Enroll;
use App\Models\FaqCategory;
use App\Models\Membership;
use App\Models\MembershipType;
use App\Models\Payment;
use App\Models\UsersCourse;
use App\Models\UserExam;
use App\Models\UserMembership;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Payments\Factory;
use Carbon\Carbon;
use DateTime;
use App\Models\PaymentDetails;
use App\Events\PopUserNotification;

class ProfileController extends Controller
{
    use MediaUploadingTrait;

    public function myprofile()
    {
        $data = auth()->user();
        if (!$data) {
            return redirect('/login');
        }
        $specialists = Specialty::select('id', 'name_en', 'name_ar')->get();
        $sup_specialists = SubSpecialty::where('specialty_id', $data->specialty_id)->get();
        $countries = Country::select("id", "country_" . app()->getLocale() . "Name as name")->whereNotIn('id', [106])->orderBy('order', 'asc')->get();

        return view('frontend.personalInfos.myprofile', compact('specialists', 'sup_specialists', 'data', 'countries'));
    }


    public function edit_myprofile(Request $request)
    {

        $dt = new Carbon();
        $before18Years = $dt->subYears(18)->format('Y-m-d');


//dd($request->toArray());
        $request->validate([
             'specialty_id' =>  ['required_if:user,1'],
             'sub_specialty_id' =>  ['required_if:user,1'],
            //  'birth_date' => 'required|date', //|after:-10 years //|before:-18 years',
            'birth_date' => ['date','required_if:user,1', 'before:' . $before18Years],
            //'degree' => 'required',
            // 'sub_degree' => 'required',
            'occupational_classification_number' => ['required_if:user,1'],
            'job_place' => ['required_if:user,1'],
            'job_name' =>  ['required_if:user,1'],
            'country' =>  ['required_if:user,1'],
            'city' =>  ['required_if:user,1'],
            'nationality_id' => ['required_if:user,1'],
            'terms' => ['required_if:user,1'],

//            'gender' =>  ['required_if:business,2'],
           //'phone' => ['required_if:business,2'],

//        'name_title' => ['required_if:business,2'],
        ]);

        $data = $request->except('password');

        $user = auth()->user();

//        if (is_array($data['phone'])) {
//            $data['phone'] = isset($data['phone']['full_number']) ? $data['phone']['full_number'] : null;
//        }
        $user->update($data);

        if ($request->business)
        {
            return redirect()->route('business-thanks', ['locale' => app()->getLocale()]);

        }

        return back()->with('message', app()->getLocale() == 'en' ? 'updated successfully' : 'تم التعديل بنجاح');
    }

    public function mymembers()
    {
        $user = auth()->user();
        $user->load('active_membership', 'last_membership', 'memberships');
        $member_ship_types = MembershipType::all();
        // dd($user->toArray());
        return view('frontend.personalInfos.mymembers', compact('user', 'member_ship_types'));
    }

    public function myinvoices()
    {
        $payments = Payment::has('payment_enrolls')->where('status_response', 'not like', '% "status":"Failed" %')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('frontend.personalInfos.myinvoices', compact('payments'));
    }

    public function printInvoice(Request $request)
    {
        $payment = null;
        try {
            $payment = Payment::where('id', $request->payment_id)->with('payment_details', 'user')->first(); //where('user_id', auth()->user()->id)->
            if (!$payment->qr_image) {
                $qrcode = \QrCode::size(155)->generate(route('invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $payment->id]));
                $payment->update(['qr_image' => $qrcode]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return view('frontend.sections.invoice', compact('payment'));
    }

    public function add_mymembers(Request $request)
    {
        $request->validate([
            'accreditation_number' => 'numeric|required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'file' => 'required|file|image|mimes:doc,pdf,docx,jpeg,png,jpg,gif,svg|max:4096'
        ]);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        if ($request->user_member_id) {
            $userMembership = UserMembership::find($request->user_member_id);
            $userMembership->update($data);

            if ($request->file('file')) {
                if (!isset($userMembership->file) || $request->file('file') !== $userMembership->file->file_name) {
                    if (isset($userMembership->file)) {
                        $userMembership->file->delete();
                    }
                    $userMembership->addMedia($request->file('file'))->toMediaCollection('file');
                }
            } elseif ($request->file('file') && isset($userMembership->file)) {
                $userMembership->file->delete();
            }
        } else {
            $userMembership = UserMembership::create($data);
            if ($request->file('file')) {
                $userMembership->addMedia($request->file('file'))->toMediaCollection('file');
            }
        }

        return back()->with('message', app()->getLocale() == 'en' ? 'subscribed successfully' : 'تم حفظ بيانات الاشتراك بنجاح');
    }

    public function changePasswordView()
    {
        return view('frontend.personalInfos.changemypassword');
    }

    public function change_mypassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => $request->new_password]);

            // event(new PopUserNotification([
            //     'user_id' => $user->id,
            //     'message' => 'change password successfuly! 😄',
            //     'title_en' => 'password',
            //     'title_ar' => 'كلمة المرور',
            //     'message_en' => 'password',
            //     'message_ar' => 'كلمة المرور',
            //     'type' => 'user',
            //     'parent_id' => null,
            // ]));

            // $user->notify( new \App\Notifications\RealTimeNotification([
            //     'user_id' => $user->id,
            //     'message' => 'change password successfuly! 😄',
            //     'title_en' => 'password',
            //     'title_ar' => 'كلمة المرور',
            //     'message_en' => 'password',
            //     'message_ar' => 'كلمة المرور',
            //     'type' => 'user',
            //     'parent_id' => null,
            // ]));

        }
        return back()->with('message', 'Password successfully changed!');
    }

    public function mycourses()
    {

        $courses = Course::withoutGlobalScopes()->whereNull('deleted_at')
        ->whereHas('payment_details_accepted', function ($q) {
            $q->where('user_id', auth()->user()->id)
            ;
        })->whereHas('user_course');


        if (request('text')) {
            $courses = $courses->where(function ($q) {
                $q->where('name_' . app()->getLocale(), 'like', '%' . request('text') . '%')
                    ->orWhere('introduction_to_course_' . app()->getLocale(), 'like', '%' . request('text') . '%');
            });
        }

        if (request('category_id')) {
            $courses = $courses->whereHas('course', function ($course) {
                $course->where('category_id', request('category_id'));
            });
        }

        if (request('price')) {
            if (request('price') == 'free') {
                $courses = $courses->whereHas('course', function ($course) {
                    $course->where(function ($q) {
                        $q->whereNull('price')->orWhere('price', '<=', 0);
                    });
                });
            } else {
                $courses = $courses->whereHas('course', function ($course) {
                    $course->whereNotNull('price')->where('price', '>', 0);
                });
            }
        }

        if (request('f_price')) {
            if (request('f_price') == 'free') {
                $courses = $courses->whereHas('course', function ($course) {
                    $course->where(function ($q) {
                        $q->whereNull('price')->orWhere('price', '<=', 0);
                    });
                });
            } else {
                $courses = $courses->whereHas('course', function ($course) {
                    $course->whereNotNull('price')->where('price', '>', 0);
                });
            }
        }

        if (request('credit')) {

            $courses =  $courses->whereHas('course', function ($course) {
                $course->whereNotNull('accreditation_number');
            });
        }

        if (request('training_type') == 'course') {
            $courses =  $courses->whereHas('course', function ($course) {
                $course->where('training_type', 'course');
            });
        }

        if (request('training_type_con') == 'conference') {
            $courses =  $courses->whereHas('course', function ($course) {
                $course->where('training_type', 'conference');
            });
        }

        if (request('history')) {
            $courses =  $courses->whereHas('course', function ($course) {
                $course->where('end_date', '<', now());
            });
        }

        if (request('sort')) {
            $courses =  $courses->where(function ($course) {
                if (request('sort') == 'date_high') {
                    $course->orderBy('start_date', 'desc');
                } else if (request('sort') == 'date_low') {
                    $course->orderBy('start_date', 'asc');
                } else if (request('sort') == 'price_high') {
                    $course->orderBy('price', 'desc');
                } else if (request('sort') == 'price_low') {
                    $course->orderBy('price', 'asc');
                }
            });

        }

        $courses = $courses->get();
        $courseCategories = CourseCategory::has('courses')->orderBy('id', 'desc')->get();
        return view('frontend.personalInfos.mycourses', compact('courses', 'courseCategories'));
    }

    public function update_personal_photo(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->personal_photo) {
            if (!$user->personal_photo || $request->personal_photo !== $user->personal_photo->file_name) {
                if ($user->personal_photo) {
                    $user->personal_photo->delete();
                }

                $user->addMedia($request->personal_photo)->toMediaCollection('personal_photo');
            }
        }
        $user = User::find(auth()->user()->id);
        return $user->personal_photo ? $user->personal_photo->url : url('/nazil/imgs/manager-1.jpeg');
    }

    public function exam_checkout($lang, $exam_id)
    {
        //        abort_if(Gate::denies('exam_checkout_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = auth()->user();
        $exam = Exam::find($exam_id);

        if (!$exam) {
            return back()->with('error', 'Exam not found');
        }
        return view('frontend.personalInfos.exam_checkout', compact('exam'));
    }

    public function user_exam_checkout(Request $request)
    {
        $data = $request->only('user_id', 'exam_id');
        $data['user_id'] = auth()->user()->id;

        $my_exam = UserExam::firstOrCreate($data);

        return redirect()->route('admin.my_exams', app()->getLocale())->with('message', 'Enrolled Successfully');
    }

    public function make_refund($lang, $course_id)
    {

        $user = auth()->user();
        $course = $user->courses()->where('users_courses.course_id', $course_id)->first();
        if (!$course) {
            return redirect(app()->getLocale() . '/mycourses')->with('message', app()->getLocale() == 'en' ? "You don't have this course" : 'انت غير مسجل بالكورس');
        }

        $enroll = Enroll::where('course_id', $course->id)->where('user_id', $user->id)->first();
        $paymentGateway = Factory::make($enroll->payment_provider);
        $res = $paymentGateway->makeRefund($course_id);

        if ($res['status'] == "success") {
            UsersCourse::where('user_id', $user->id)
                ->where('course_id', $course_id)
                ->delete();
            $enroll->status = 2;
            $enroll->update();

            return redirect(app()->getLocale() . '/mycourses')->with('message', app()->getLocale() == 'en' ? 'Refund has been Initiated Successfully' : 'تم تسجيل طلب الاسترجاع');
        }

        return redirect(app()->getLocale() . '/mycourses')->with('message', app()->getLocale() == 'en' ? 'Refund Request Not Completed' : 'لم يتم تسجيل طلب الاسترجاع');
    }

    public function myquizes(Request $request)
    {
        $quizes_scores = CourseQuizeScore::where('user_id', auth()->user()->id)->get();

        return view('frontend.personalInfos.myquizes', compact('quizes_scores'));
    }


    public function wallet()
    {
        $wallet = Wallet::firstOrCreate(['user_id' => auth()->user()->id]);
        $wallet_faq = FaqCategory::with('faqQuestions')->where('category_en', 'like', '%wallet%')->first();
        $user = auth()->user();
        $points = Point::firstOrCreate(['user_id' => $user->id]);
        $points = new PointResource($points);
        $points_faq = FaqCategory::with('faqQuestions')->where('category_en', 'like', '%points%')->first();

        return view('frontend.personalInfos.wallet', compact('wallet', 'wallet_faq', 'points', 'points_faq'));
    }

    public function get_course_item_data($lang, $id, $payment_id = null)
    {
        $course_id = $id;
        $cancel_request = CancelRequest::where(['course_id' => $course_id, 'user_id' => auth()->user()->id, 'payment_id' => $payment_id])->where(function ($query) {
            $query->where('approved', 0)->where('rejected', 0);
        })->first();
        if (!$cancel_request) {
            $cancellation = CancelationPolicy::with('cancelationValues')->where('course_id', $course_id)->first();
            $enroll = PaymentDetails::with('course')->where(['course_id' => $course_id, 'user_id' => auth()->user()->id])->first();
            if (!$enroll) {
                return $this->toJson(false, 400, 'this course not enrolled');
            }

            $now = new DateTime(now());
            $course_start_date = new DateTime($enroll->course->start_date);

            $days = $course_start_date->diff($now)->format("%a"); //3

            $cancel_policy = CancelationPolicy::where('course_id', $course_id)
                ->whereHas('cancelValue', function ($values) use ($days) {
                    if ($days > 21) {
                        $values->where('days', '>=', 21);
                    } elseif ($days <= 21 && $days > 3) {
                        $values->where('days', '<=', 21)->where('days', '>', 3);
                    } elseif ($days <= 3) {
                        $values->where('days', '<=', 3);
                    }
                })
                ->with([
                    'cancelValue' => function ($values) use ($days) {
                        if ($days > 21) {
                            $values->where('days', '>=', 21);
                        } elseif ($days <= 21 && $days > 3) {
                            $values->where('days', '<=', 21)->where('days', '>', 3);
                        } elseif ($days <= 3) {
                            $values->where('days', '<=', 3);
                        }
                    },
                ])
                ->first();

            $service_fees = $enroll->payment ? ($enroll->payment->payment_method ? $enroll->payment->payment_method->service_fees : 0) : 0;
            $current_price = $enroll->final_price - ($enroll->final_price * $service_fees / 100);

            $amount = 0;
            if ($cancel_policy) {
                $amount = $current_price * ($cancel_policy->cancelValue->amount / 100);
            } else {
                if ($days > 3 && $days < 21)
                    $amount = $current_price * (25 / 100);
            }

            $price = $enroll->final_price > 0  &&  $amount < $current_price ? $current_price - $amount : 0;
            $msg = trans('lms.refund_course_price_is') . ' ' . get_price($price);
            $valid = 1;
        } elseif ($cancel_request && $cancel_request->approved == 0) {
            $msg = trans('lms.cancel_request_is_pending_for_admin_cancellation');
            $valid = 0;
        } elseif ($cancel_request && $cancel_request->approved && $cancel_request->status) {
            $msg = trans('lms.this_course_cancelled_by_admin');
            $valid = 0;
        }

        $course = Course::withoutGlobalScope(PublishedScope::class)->withTrashed()->where('id', $id)->first();

        if (!$course) {
            return false;
        }

        if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price) {
            $price = $course->price . ' ' . __('lms.SR');
        }
        if (isset($course->today_price)) {
            $price = $course->today_price . ' ' . __('lms.SR');
        } elseif (isset($course->has_general_price)) {
            if ($course->price == 0) {
                $price = __('lms.free');
            } else {
                if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price) {
                    $price = $course->member_price . ' ' . __('lms.SR');
                    $old_price = $course->price . ' ' . __('lms.SR');
                } else {
                    $price = $course->price . ' ' . __('lms.SR');
                }
            }
        } elseif (count($course->prices) && !$course->has_general_price) {
            $price = __('lms.different_prices');
        } else {
            $price = __('lms.free');
        }

        return response()->json([
            'name' => $course->name,
            'date' => $course->start_date,
            'coursePlace' => $course->coursePlace->title,
            'price' => isset($price) ? $price : '',
            'oldprice' => isset($old_price) ? $old_price : '',
            'msg' => $msg,
            'valid' => $valid,
            'image' => asset($course->image->url ?? '/afaq/imgs/Maskasde.png')
        ]);
    }

    public function refund_course_action(Request $request)
    {
        $v = $this->validate(request(), [
            'course_id' => 'required',
            'cancel_reason' => 'required',
        ]);


        $course_id = $request->course_id;
        $cancellation = CancelationPolicy::with('cancelationValues')->where('course_id', $course_id)->first();
        $enroll = Enroll::with('course')->where(['course_id' => $course_id, 'user_id' => auth()->user()->id])->first();
        if (!$enroll) {
            return $this->toJson(false, 400, 'this course not enrolled');
        }

        $now = new DateTime(now());
        $course_start_date = new DateTime($enroll->course->start_date);

        $days = $course_start_date->diff($now)->format("%a"); //3

        $cancel_policy = CancelationPolicy::where('course_id', $course_id)
            ->whereHas('cancelValue', function ($values) use ($days) {
                if ($days > 21) {
                    $values->where('days', '>=', 21);
                } elseif ($days <= 21 && $days > 3) {
                    $values->where('days', '<=', 21)->where('days', '>', 3);
                } elseif ($days <= 3) {
                    $values->where('days', '<=', 3);
                }
            })
            ->with([
                'cancelValue' => function ($values) use ($days) {
                    if ($days > 21) {
                        $values->where('days', '>=', 21);
                    } elseif ($days <= 21 && $days > 3) {
                        $values->where('days', '<=', 21)->where('days', '>', 3);
                    } elseif ($days <= 3) {
                        $values->where('days', '<=', 3);
                    }
                },
            ])
            ->first();

        $service_fees = $enroll->payment ? ($enroll->payment->payment_method ? $enroll->payment->payment_method->service_fees : 0) : 0;
        $current_price = $enroll->final_total - ($enroll->final_total * $service_fees / 100);

        $amount = 0;
        if ($cancel_policy) {
            $amount = $current_price * ($cancel_policy->cancelValue->amount / 100);
        } else {
            if ($days > 3 && $days < 21)
                $amount = $current_price * (25 / 100);
        }

        $price = $enroll->final_total > 0  &&  $amount < $current_price ? $current_price - $amount : 0;

        $cancel_request = CancelRequest::firstOrCreate([
            'course_id' => $request->course_id,
            'user_id' => auth()->user()->id,
            'amount' => $price,
            'type' => null,
            'status' => 1,
            'approved' => 0,
            'payment_id' => $request->payment_id,
            'cancel_reason' => $request->cancel_reason
        ]);

        return back()->with('message', trans('lms.cancel_request_created_successfully'));
    }
    /**
     * My Tickets View
     */
    public function mytickets(Request $request)
    {
        $user = auth()->user()->id;
        $tickets = Ticket::where('user_id', $user)->where('type','AFAQ')->with('user', 'ticket_category')->get();
        $categories = TicketCategory::where('status', 1)->where('type','AFAQ')->get();
        return view('frontend.personalInfos.mytickets', compact('user', 'categories', 'tickets'));
    }
    /**
     *
     * My Tickets
     */
    public function add_tickets(Request $request)
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
        if (isset($details['image'])) {

            $data['image'] = $data['image']->store('ticket-image', 'public');

        }
        $ticket = Ticket::create($data);

        //        return redirect()->back()->withStatus('Your ticket has been submitted, we will be in touch. You can view ticket status
        //        ');
        //        <a href="'.route('tickets.show', $ticket->id).'">here</a>
        return back()->with('message', app()->getLocale() == 'en' ? 'Your ticket has been submitted, we will be in touch.' : 'تم حفظ بيانات لتذكرة بنجاح');
    }
    public function show(Ticket $ticket)
    {
        $ticket->load('comments');

        return view('tickets.show', compact('ticket'));
    }

    //    public function storeComment(Request $request, Ticket $ticket)
    //    {
    //
    //        $request->validate([
    //            'comment_text' => 'required'
    //        ]);
    //
    //        $comment = $ticket->comments()->create([
    //            'author_name'   => $ticket->author_name,
    //            'author_email'  => $ticket->author_email,
    //            'comment_text'  => $request->comment_text
    //        ]);
    //
    //        $ticket->sendCommentNotification($comment);
    //
    //        return redirect()->back()->withStatus('Your comment added successfully');
    //    }

    /**
     *
     * Complete Data
     */
    public function complete_profile(Request $request)
    {
        $data = auth()->user();
        if (!$data) {
            return redirect('/login');
        }
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $specialists = Specialty::select('id', 'name_en', 'name_ar')->get();
        $sup_specialists = SubSpecialty::where('specialty_id', $data->specialty_id)->get();
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        $countries = Country::select("id", "country_" . app()->getLocale() . "Name as name")->orderBy('order', 'asc')->get();
        return view('frontend.personalInfos.complete_profile',compact('specialists',  'countries','data' ,'sup_specialists','ContentCategory'));
    }

    /**
     * Get city
     */
    public function get_city($lang, $id)
    {
        $id = explode(',', $id);
        return  Country::whereIn('parent_id', $id)
            // ->select('country_' . app()->getLocale() .'Name' ' as name', 'name_en as en', 'name_ar as ar', 'id')

            ->select('id', 'country_' . app()->getLocale() .'Name  as name')
           // ->whereNotNull('parent_id')
            ->get();
//        dd($city);
    }
}
