<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstructorRequest;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class InstructorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors = Instructor::with(['specialization', 'media'])->get();

        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        abort_if(Gate::denies('instructor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        $specializations = Specialty::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');
        $specializations = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instructors.create', compact('specializations'));
    }

    public function store(StoreInstructorRequest $request)
    {
        $instructor = Instructor::create($request->all());

//        if ($request->input('image', false)) {
//            $instructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
//        }
//
//        if ($media = $request->input('ck-media', false)) {
//            Media::whereIn('id', $media)->update(['model_id' => $instructor->id]);
//        }
        if ($request->file('image', false)) {
            $instructor->addMedia($request->file('image'))->toMediaCollection('image');
        }
        if ($request->input('resume', false)) {
            $instructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume'))))->toMediaCollection('InstructorResume');
        }
        if($request->ajax()){
            return response()->json($instructor,200);
        }else{
            return redirect()->route('admin.instructors.index');
        }
    }

    public function edit(Instructor $instructor)
    {
        abort_if(Gate::denies('instructor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $specializations = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id');
        $instructor->load('specialization');

        return view('admin.instructors.edit', compact('instructor','specializations'));
    }

    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $instructor->update($request->all());

//        if ($request->input('image', false)) {
//            if (!$instructor->image || $request->input('image') !== $instructor->image->file_name) {
//                if ($instructor->image) {
//                    $instructor->image->delete();
//                }
//                $instructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
//            }
//        } elseif ($instructor->image) {
//            $instructor->image->delete();
//        }
        if ($request->file('image', false)) {
            if (!$instructor->image || $request->file('image') !== $instructor->image->file_name) {
                if ($instructor->image) {
                    $instructor->image->delete();
                }
                $instructor->addMedia($request->file('image'))->toMediaCollection('image');
            }
        }
        if ($request->input('resume', false)) {
            if (! $instructor->resume || $request->input('resume') !== $instructor->resume->file_name) {
                if ($instructor->resume) {
                    $instructor->resume->delete();
                }
                $instructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume'))))->toMediaCollection('InstructorResume');
            }
        } elseif ($instructor->resume) {
            $instructor->resume->delete();
        }
        return redirect()->route('admin.instructors.index');
    }

    public function show(Instructor $instructor)
    {
        abort_if(Gate::denies('instructor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructor->load('specialization');

        return view('admin.instructors.show', compact('instructor'));
    }

    public function destroy(Instructor $instructor)
    {
        abort_if(Gate::denies('instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructor->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyInstructorRequest $request)
    {
        Instructor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('instructor_create') && Gate::denies('instructor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Instructor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function instructors_view()
    {
        $instructors = Instructor::with(['media'])->orderBy('order','asc')->get();
        return view('admin.instructors.reorder',compact('instructors'));
    }
    public function sort_instructor(Request $request)

    {
        foreach ($request->order as $key => $order) {
            $instructors = Instructor::find($order['id'])->update(['order' => $order['order']]);
        }
        return response('Update Successfully.', 200);
    }
}
