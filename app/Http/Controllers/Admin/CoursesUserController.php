<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExcelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCoursesUserRequest;
use App\Http\Requests\StoreCoursesUserRequest;
use App\Http\Requests\UpdateCoursesUserRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseQuize;
use App\Models\Enroll;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\UsersCourse;
use Gate;
use Google\Service\CloudSourceRepositories\Repo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;
use Excel;
class CoursesUserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('courses_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = Course::with(['category', 'instructor', 'media']);
        $courses = $courses->orderBy('id', 'desc')->get();
        $courseCategories = CourseCategory::get();
        $specialties = Specialty::get();
        $subSpecialties = SubSpecialty::get();
        return view('admin.reports.coursesUsers.index', compact('courses', 'courseCategories', 'specialties', 'subSpecialties'));
    }


    public function show(Request $request)
    {
        $course = $request->course_user;
        $quizes = CourseQuize::where('course_id', $course)->whereHas('lecture')->get();

        if ($request->ajax()) {
            $courses = UsersCourse::where('course_id', $course);
            $courses = $courses->orderBy('id', 'desc');

            $q =  DataTables::of($courses)
                ->addColumn('id', function ($row) {
                    return $row->user_id;
                })
                ->addColumn('name_ar', function ($row) {
                    return  $row->user->full_name_ar;
                })
                ->addColumn('name_en', function ($row) {
                    return  $row->user->full_name_en ;
                })
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('phone', function ($row) {
                    return $row->user->phone;
                })
                ->addColumn('gender', function ($row) {
                    return $row->user->gender == 'male' ? (app()->getLocale() == 'ar' ? 'ذكر' : 'Male') : (app()->getLocale() == 'ar' ? 'أنثي' : 'Female');
                })
                ->addColumn('nationality', function ($row) {
                    return $row->user->country_and_nationality->nationality ?? '';
                })
                ->addColumn('occupational_classification_number', function ($row) {
                    return $row->user->occupational_classification_number;
                })
                ->addColumn('specialty', function ($row) {
                    return app()->getLocale() == 'en' ? $row->user->specialty->name_en ?? '' : $row->user->specialty->name_ar ?? '';
                })
                ->addColumn('sub_specialty', function ($row) {
                    return app()->getLocale() == 'en' ? $row->user->SubSpecialty->name_en ?? '' : $row->user->SubSpecialty->name_ar ?? '';
                })
                ->addColumn('verified', function ($row) {
                    return $row->user->verified;
                })

                ->addColumn('completion_date', function ($row) {
                    return $row->completion_date;
                })

                ->addColumn('completion_percentage', function ($row) {
                    return $row->completion_percentage;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                });

                $quizes = CourseQuize::where('course_id', $course)->whereHas('lecture')->get();
            foreach ($quizes as $quiz) {
                $q =  $q->addColumn('score_percentage_' . $quiz->id, function ($row) use ($quiz) {
                    return $quiz->score()->where('user_id', $row->user_id)->first()->score_percentage ?? '';
                });
                $q =  $q->addColumn('repeat_times_' . $quiz->id, function ($row) use ($quiz) {
                    return $quiz->score()->where('user_id', $row->user_id)->first()->repeat_times ?? '';
                });
            }

            $q =  $q->make(true);

            return $q;
        }
        return view('admin.reports.coursesUsers.CoursesUsers', compact('quizes'));
    }

    public function export_course_users(Request $request,$course_user)
    {
        $course = $course_user;
        $quizes = CourseQuize::where('course_id', $course)->whereHas('lecture')->get();

        $courses = UsersCourse::where('course_id', $course);
        $courses = $courses->orderBy('id', 'desc')->get();
        $data = array();
        foreach ($courses as $row) {

            $row_data = [
                'id' => $row->user_id,
                'name_ar' =>  $row->user->full_name_ar ?? '',
                'name_en' => $row->user->full_name_en ?? '',
                'email' => $row->user->email ?? '',
                'user_name' => $row->user->name ?? '',
                'phone' => $row->user->phone ?? '',
                'gender' => (isset($row->user->gender) && $row->user->gender == 'male') ? (app()->getLocale() == 'ar' ? 'ذكر' : 'Male') : (app()->getLocale() == 'ar' ? 'أنثي' : 'Female'),

                'nationality' => $row->user->country_and_nationality->nationality ?? '',
                'occupational_classification_number' => $row->user->occupational_classification_number ?? '',
                'specialty' => app()->getLocale() == 'en' ? $row->user->specialty->name_en ?? '' : $row->user->specialty->name_ar ?? '',
                'sub_specialty' =>  app()->getLocale() == 'en' ? $row->user->SubSpecialty->name_en ?? '' : $row->user->SubSpecialty->name_ar ?? '',

                'verified' => $row->user->verified ?? '',
                'created_at' => $row->created_at ?? '',
                'completion_date' => $row->completion_date,

                'completion_percentage' => $row->completion_percentage,

            ];
            $quizes = CourseQuize::where('course_id', $course)->whereHas('lecture')->get();
            foreach ($quizes as $quiz) {
                $row_data['score_percentage_' . $quiz->id] = $quiz->score()->where('user_id', $row->user_id)->first()->score_percentage ?? '';
                $row_data['repeat_times_' . $quiz->id] = $quiz->score()->where('user_id', $row->user_id)->first()->repeat_times ?? '';
            }

            array_push($data, $row_data);
        }

        $headers = [
            trans('cruds.user.fields.id'),

            trans('cruds.header.fields.name_ar'),
            trans('cruds.header.fields.name_en'),

            trans('cruds.user.fields.email'),

            trans('cruds.user.fields.user_name'),


            trans('cruds.blogscomment.fields.phone_helper'),

            trans('frontend.register.gender'),

            trans('cruds.user.fields.nationality'),

            trans('frontend.register.occupational_classification_number'),
            trans('frontend.register.Field of your specialist study'),
            trans('frontend.register.Field of your sub specialist study'),
            trans('cruds.user.fields.verified'),
            trans('cruds.user.fields.join_course_date'),
            trans('cruds.user.fields.completion_date'),

            trans('cruds.user.fields.completion_percentage'),



        ];
        foreach ($quizes as $quiz) {
            array_push($headers, trans('cruds.exam.fields.success_percentage')  . __('afaq.For') .
                app()->getLocale() == 'en' ? $quiz->title_en ?? '' : $quiz->title_ar ?? '');

            array_push($headers, trans('lms.repeat_times')  . __('afaq.For') .
                app()->getLocale() == 'en' ? $quiz->title_en ?? '' : $quiz->title_ar ?? '');
        }

        return Excel::download(new ExcelExport($data, $headers), 'course_users.xlsx');

    }
    public function course_invoice_report($course_id)
    {
        $courses = Enroll::with('course', 'user', 'payment', 'bank_invoice')
            ->whereHas('payment', function ($q) {
                $q->where('status', 1)->where('approved', 1);
            })
            ->where('course_id', $course_id)
            // ->where('status', 1)
            ->where('approved', 1)
            ->get();

        return view('admin.reports.coursesUsers.CourseInvoice', compact('courses'));
    }
}
