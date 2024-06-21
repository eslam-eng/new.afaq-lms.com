<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserCourseRequest;
use App\Http\Requests\StoreUserCourseRequest;
use App\Http\Requests\UpdateUserCourseRequest;
use App\Models\Country;
use App\Models\Enroll;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserCoursesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $users = User::with('country_and_nationality')
                ->whereHas('roles', function ($q) {
                    $q->where('id', 3);
                })->with('specialty', 'SubSpecialty', 'country_and_nationality')
                ->where('verified', 1)
                ->orderBy('id', 'desc');

            return DataTables::of($users)->make(true);
        } else {
            $specialties = Specialty::get();
            $subSpecialties = SubSpecialty::get();
            $countries = Country::get();

            return view('admin.reports.userCourses.index',compact('specialties','subSpecialties','countries'));
        }

    }



    public function show($user)
    {
        $enrolls = Enroll::where('user_id', $user)->where('approved', 1)
            ->whereHas('payment', function ($q) {
                $q->where('status', 1)->where('approved', 1);
            })
            ->pluck('course_id')->toArray();
        $userCourse = User::find($user);
        $userCourse->load(['courses' => function ($courses) use ($enrolls) {
            $courses->whereIn('course_id', $enrolls)->distinct();
        }]);
        // dd($userCourse->toArray());
        return view('admin.reports.userCourses.courses', compact('userCourse'));
    }
}
