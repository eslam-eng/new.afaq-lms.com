<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserAttendanceRequest;
use App\Http\Requests\StoreUserAttendanceRequest;
use App\Http\Requests\UpdateUserAttendanceRequest;
use App\Models\AttendanceDesign;
use App\Models\Course;
use App\Models\User;
use App\Models\UserAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAttendances = UserAttendance::where('lecture_id',request('lecture_id'))->with(['user', 'course', 'attendance_design'])->get();

        return view('admin.userAttendances.index', compact('userAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance_designs = AttendanceDesign::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userAttendances.create', compact('attendance_designs', 'courses', 'users'));
    }

    public function store(StoreUserAttendanceRequest $request)
    {
        $userAttendance = UserAttendance::create($request->all());

        return redirect()->route('admin.user-attendances.index');
    }

    public function edit(UserAttendance $userAttendance)
    {
        abort_if(Gate::denies('user_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance_designs = AttendanceDesign::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userAttendance->load('user', 'course', 'attendance_design');

        return view('admin.userAttendances.edit', compact('attendance_designs', 'courses', 'userAttendance', 'users'));
    }

    public function update(UpdateUserAttendanceRequest $request, UserAttendance $userAttendance)
    {
        $userAttendance->update($request->all());

        return redirect()->route('admin.user-attendances.index');
    }

    public function show(UserAttendance $userAttendance)
    {
        abort_if(Gate::denies('user_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAttendance->load('user', 'course', 'attendance_design');

        return view('admin.userAttendances.show', compact('userAttendance'));
    }

    public function destroy(UserAttendance $userAttendance)
    {
        abort_if(Gate::denies('user_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAttendanceRequest $request)
    {
        $userAttendances = UserAttendance::find(request('ids'));

        foreach ($userAttendances as $userAttendance) {
            $userAttendance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
