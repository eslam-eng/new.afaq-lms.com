<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseCategoryRequest;
use App\Http\Requests\StoreCourseCategoryRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Models\CourseCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseCategories = CourseCategory::all();

        return view('admin.courseCategories.index', compact('courseCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseCategories.create');
    }

    public function store(StoreCourseCategoryRequest $request)
    {
        $courseCategory = CourseCategory::firstOrCreate($request->validated());

        return redirect()->route('admin.course-categories.index');
    }

    public function edit(CourseCategory $courseCategory)
    {
        abort_if(Gate::denies('course_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseCategories.edit', compact('courseCategory'));
    }

    public function update(UpdateCourseCategoryRequest $request, CourseCategory $courseCategory)
    {
        $courseCategory->update($request->all());

        return redirect()->route('admin.course-categories.index');
    }

    public function show(CourseCategory $courseCategory)
    {
        abort_if(Gate::denies('course_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseCategories.show', compact('courseCategory'));
    }

    public function destroy(CourseCategory $courseCategory)
    {
        abort_if(Gate::denies('course_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseCategory->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCourseCategoryRequest $request)
    {
        CourseCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Change Status
     */
    public function ChangeFeatured(Request $request)
    {
        $input = $request->all();
        $courseCategory = CourseCategory::find($request->course_category_id);

        $courseCategory->featured = $request->featured;
        $courseCategory->save();
        return response()->json(['success' => 'Featured change successfully.']);
    }
}
