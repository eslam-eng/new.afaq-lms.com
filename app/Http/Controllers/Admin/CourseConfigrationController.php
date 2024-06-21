<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseConfigrationRequest;
use App\Http\Requests\StoreCourseConfigrationRequest;
use App\Http\Requests\UpdateCourseConfigrationRequest;
use App\Models\CourseConfigration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseConfigrationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_configration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseConfigrations = CourseConfigration::all();

        return view('admin.courseConfigrations.index', compact('courseConfigrations'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_configration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseConfigrations.create');
    }

    public function store(StoreCourseConfigrationRequest $request)
    {
        $courseConfigration = CourseConfigration::create($request->all());

        return redirect()->route('admin.course-configrations.index');
    }

    public function edit(CourseConfigration $courseConfigration)
    {
        abort_if(Gate::denies('course_configration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseConfigrations.edit', compact('courseConfigration'));
    }

    public function update(UpdateCourseConfigrationRequest $request, CourseConfigration $courseConfigration)
    {
        $courseConfigration->update($request->all());

        return redirect()->route('admin.course-configrations.index');
    }

    public function show(CourseConfigration $courseConfigration)
    {
        abort_if(Gate::denies('course_configration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseConfigrations.show', compact('courseConfigration'));
    }

    public function destroy(CourseConfigration $courseConfigration)
    {
        abort_if(Gate::denies('course_configration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseConfigration->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCourseConfigrationRequest $request)
    {
        CourseConfigration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
