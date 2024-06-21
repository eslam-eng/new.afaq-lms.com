<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseInvoiceRequest;
use App\Http\Requests\StoreCourseInvoiceRequest;
use App\Http\Requests\UpdateCourseInvoiceRequest;
use App\Models\BankInvoice;
use App\Models\BankList;
use App\Models\Course;
use App\Models\CourseInvoice;
use App\Models\Enroll;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UsersCourse;
use App\Notifications\InvoiceBankTransfereCoursePAymentNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class CourseInvoicesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $function = \Request::segment(2);
            $reservations = new Payment;
            $request->request->add(['provider' => $request['amp;provider'],'date_from' => $request['amp;date_from'], 'date_to' => $request['amp;date_to'], 'wallet' => $request['amp;wallet'], 'status' => $request['amp;status']]);
            if (request('provider')) {
                $reservations = $reservations->where('provider', request('provider'));
            }
            if (request('course')) {
                $reservations = $reservations->whereHas('payment_details', function ($payment_details) {
                    $payment_details->where('course_id', request('course'));
                });
            }
            if (request('status') == 1) {
                $reservations = $reservations->where('status', 0) //status For user upload image , approved for admin approve request
                    ->where('approved', 0);
            } elseif (request('status') == 2) {
                $reservations = $reservations->where('status', 1)
                    ->where('approved', 0);
            } elseif (request('status') == 3) {
                $reservations = $reservations->where('status', 1)
                    ->where('approved', 1);
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

            $reservations = $reservations->whereNull('deleted_at')->where('provider','!=','Hyber')->with('payment_invoices')->orderBy('id', 'desc');
            return DataTables::of($reservations)

                ->addColumn('user_email', function ($row) {
                    return $row->user ? $row->user->email : '';
                })
                ->filterColumn('user_email', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('email', 'like', '%' . $keyword . '%');
                    });
                })


                ->addColumn('user_phone', function ($row) {
                    return $row->user ? $row->user->phone : '';
                })
                ->filterColumn('user_phone', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('phone', 'like', '%' . $keyword . '%');
                    });
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
        $paymethod = Payment::select('provider')->where('provider','!=','Hyber')->distinct()->groupBy('provider')->get();
        $courses = Course::get();
        return view('admin.courseInvoices.index', compact('paymethod','courses'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankList::pluck('name_' . app()->getLocale() . ' as name', 'id');

        // $users = User::pluck('email', 'id')->toArray();
        $courses = Course::where('status', 1)->get();
        $methods = PaymentMethod::where('type', 'offline')->where('status', 1)->get();
        //dd($methods);
        return view('admin.courseInvoices.create', compact('banks', 'courses', 'methods'));
    }

    public function store(StoreCourseInvoiceRequest $request)
    {
        $data = $request->all();

        $data['invoice_id'] = date('Y') . time() . rand(1000, 9999);
        $data['date'] = date('Y-m-d', strtotime($data['date']));

        $courses = Course::select('id')->whereIn('id', $data['courses_ids'])->get();

        $valid = true;
        $msgs = [];
        foreach ($courses as $key => $value) {
            $check = UsersCourse::where(['user_id' => $data['user_id'], 'course_id' => $value->id])->first();
            if ($check) {
                $valid = false;
                $msgs[] = "Course: " . $check->course->name . " already enrolled .";
                return back()->with('error', "Course: " . $check->course->name . " already enrolled .");
            }
        }

        unset($data['courses_ids']);

        $courseInvoice = BankInvoice::create($data);


        // if ($request->input('invoice_image', false)) {
        //     $courseInvoice->addMedia(storage_path('tmp/uploads/' . $request->input('invoice_image')))->toMediaCollection('invoice_image');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $courseInvoice->id]);
        // }

        $this->enrollCourses($courseInvoice, $courses);

        return redirect()->route('admin.course-invoices.index');
    }

    public function edit(BankInvoice $courseInvoice)
    {
        abort_if(Gate::denies('course_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankList::pluck('name_' . app()->getLocale() . ' as name', 'id');

        $users = User::pluck('email', 'id')->toArray();
        $courses = Course::where('status', 1)->pluck('name_' . app()->getLocale() . ' as name', 'id');
        $methods = PaymentMethod::select('name_' . app()->getLocale() . ' as name', 'id')->where('type', 'offline')->where('status', 1)->get();

        $courseInvoice->load('bank');

        return view('admin.courseInvoices.edit', compact('banks', 'courseInvoice', 'users', 'courses', 'methods'));
    }

    public function update(UpdateCourseInvoiceRequest $request, BankInvoice $courseInvoice)
    {
        $courseInvoice->update($request->all());

        if ($request->file('invoice_image', false)) {
            if (!$courseInvoice->invoice_image || $request->file('invoice_image') !== $courseInvoice->invoice_image->file_name) {
                if ($courseInvoice->invoice_image) {
                    $courseInvoice->invoice_image->delete();
                }
                $courseInvoice->addMedia($request->file('invoice_image'))->toMediaCollection('invoice_image');
            }
        }
        return redirect()->route('admin.course-invoices.index');
    }

    public function show(BankInvoice $courseInvoice)
    {
        abort_if(Gate::denies('course_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInvoice->load('bank', 'user', 'courses', 'ReaservationCourse');
        $payment = Payment::select('id', 'approved')->where('transaction', $courseInvoice->invoice_id)->first();

        return view('admin.courseInvoices.show', compact('courseInvoice', 'payment'));
    }

    public function destroy(BankInvoice $courseInvoice)
    {
        abort_if(Gate::denies('course_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInvoice->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCourseInvoiceRequest $request)
    {
        BankInvoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_invoice_create') && Gate::denies('course_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BankInvoice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function enrollCourses($invoice, $items)
    {
        try {
            DB::beginTransaction();

            $payment_method = PaymentMethod::where('id', $invoice->payment_method_id)->first();
            $provider = $payment_method ? $payment_method->provider : '';

            $payment = Payment::firstOrCreate(
                [
                    'provider' => $provider,
                    'transaction' => $invoice->invoice_id,
                ],
                [
                    'payment_method_id' => $invoice->payment_method_id,
                    'payment_number' => $invoice->invoice_id,
                    'user_id' => $invoice->user_id,
                    'amount' => $invoice->amount,
                    'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1,
                    'status' => 1,
                    'approved' => 1
                ]
            );

            foreach ($items as $key => $item) {
                $enroll_data['course_id'] = $item->id;
                $enroll_data['user_id'] = $invoice->user_id;
                $enroll_data['coupon'] = null;
                $enroll_data['coupon_type'] =  null;
                $enroll_data['coupon_amount'] =  null;
                $enroll_data['course_price'] =  $invoice->amount;
                $enroll_data['total'] =  $invoice->amount;
                $enroll_data['final_total'] =   $invoice->amount;
                $enroll_data['payment_id'] = $payment->id;
                $enroll_data['approved'] = 1;
                $enroll_data['payment_provider'] =  $provider;
                $enroll_data['provider_payment_id'] =  $invoice->invoice_id;
                $enroll_data['status'] = 1;
                $enroll_data['approved'] = 1;
                UsersCourse::updateOrCreate(['course_id' => $item->id, 'user_id' => $invoice->user_id]);
                $enroll = Enroll::updateOrCreate([
                    'course_id' => $enroll_data['course_id'],
                    'user_id'   => $enroll_data['user_id'],
                ], $enroll_data);

                PaymentDetails::updateOrCreate(
                    [
                        'course_id' => $item->id,
                        'user_id' => $invoice->user_id,
                        'status' => 1,
                        'payment_number' => $invoice->invoice_id
                    ],
                    [
                        'payment_id' => $payment->id,
                        'course_id' => $item->id,
                        'instructor_id' => null,
                        'user_id' => $invoice->user_id,
                        'payment_number' => $invoice->invoice_id,
                        'course_name_en' => $enroll->course->name_en ?? $item->name,
                        'course_name_ar' => $enroll->course->name_ar ?? $item->name,
                        'course_image_url' => $item->image->url ?? null,
                        'instructor_name_en' => null,
                        'instructor_name_ar' => null,
                        'user_name_en' => $invoice->user->full_name_en ?? $invoice->user->name,
                        'user_name_ar' => $invoice->user->full_name_ar ?? $invoice->user->name,
                        'price' => $invoice->amount,
                        'offer' => null,
                        'final_price' =>  $invoice->amount,
                        'status' =>  1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }

            try {
                Notification::send($invoice->user, new InvoiceBankTransfereCoursePAymentNotification($payment));
                $this->save_log(auth()->user()->id, "The user: " .  $invoice->user->full_name_en . " complete checkout " + $item->name_en + " Course.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            DB::commit();

            return redirect('/admin/course-invoices/' . $invoice->id)->with('message', 'Invoice has been created');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
