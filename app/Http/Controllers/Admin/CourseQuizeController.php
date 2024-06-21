<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseQuizeRequest;
use App\Http\Requests\StoreCourseQuizeRequest;
use App\Http\Requests\UpdateCourseQuizeRequest;
use App\Models\Course;
use App\Models\CourseQuize;
use App\Models\CourseQuizeScore;
use App\Models\ExamsTitle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseQuizeController extends Controller
{
    use MediaUploadingTrait;

    public function index($course_id)
    {
        abort_if(Gate::denies('course_quize_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseQuizes = CourseQuize::where('course_id',$course_id)->with(['course', 'exam_title', 'media'])->get();

        return view('admin.courseQuizes.index', compact('courseQuizes','course_id'));
    }

    public function create($course_id)
    {
        abort_if(Gate::denies('course_quize_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courseQuizes.create', compact('courses', 'exam_titles','course_id'));
    }

    public function store(Request $request)
    {
        $request->merge(['course_id'=>$request->course_id]);

        $courseQuize = CourseQuize::create($request->all());

        if ($request->input('image', false)) {
            $courseQuize->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseQuize->id]);
        }

        if($request->ajax()){
            return true;
        }else{

            return redirect()->route('admin.course-quizes.index',['course_id' => $request->course_id]);
        }
    }

    public function edit(Request $request , $course_id)
    {
        abort_if(Gate::denies('course_quize_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $courseQuize = CourseQuize::where('id',$request->id)->where('course_id',$course_id)->first();
        $courseQuize->load('course', 'exam_title');

        return view('admin.courseQuizes.edit', compact('courseQuize', 'exam_titles','course_id'));
    }

    public function update(Request $request,$id)
    {
        $courseQuize = CourseQuize::find($id);
        if($courseQuize){
            $courseQuize->update($request->except(['_method','_token','image']));

            if ($request->input('image', false)) {
                if (!$courseQuize->image || $request->input('image') !== $courseQuize->image->file_name) {
                    if ($courseQuize->image) {
                        $courseQuize->image->delete();
                    }elseif(is_file($request->input('image', false))){
                        $courseQuize->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
                    }
                }
            } elseif ($courseQuize->image) {
                $courseQuize->image->delete();
            }
        }

        if($request->ajax()){
            return true;
        }else{
            return redirect()->route('admin.course-quizes.index',['course_id' => $request->course_id]);
        }

    }

    public function show(Request $request,CourseQuize $courseQuize)
    {
        abort_if(Gate::denies('course_quize_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseQuize = CourseQuize::where('id',$request->id)->first();

        return view('admin.courseQuizes.show', compact('courseQuize'));
    }

    public function destroy(CourseQuize $courseQuize)
    {
        abort_if(Gate::denies('course_quize_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseQuize->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseQuizeRequest $request)
    {
        CourseQuize::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_quize_create') && Gate::denies('course_quize_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseQuize();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function results(Request $request)
    {
        $quizes_scores = CourseQuizeScore::where('quize_id',$request->id)->get();
        $courseQuize = CourseQuize::find($request->id);
        return view('admin.courseQuizes.quize-answers',compact('quizes_scores','courseQuize'));
    }
}
