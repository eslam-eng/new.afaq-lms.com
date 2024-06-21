<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentMoodleRequest;
use App\Http\Requests\StoreStudentMoodleRequest;
use App\Http\Requests\UpdateStudentMoodleRequest;
use App\Models\StudentMoodle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StudentMoodleController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_moodle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMoodles = StudentMoodle::with(['media'])->get();

        return view('admin.studentMoodles.index', compact('studentMoodles'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_moodle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentMoodles.create');
    }

    public function store(StoreStudentMoodleRequest $request)
    {
        $studentMoodle = StudentMoodle::create($request->all());

        if ($request->input('image', false)) {
            $studentMoodle->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $studentMoodle->id]);
        }

        return redirect()->route('admin.student-moodles.index');
    }

    public function edit(StudentMoodle $studentMoodle)
    {
        abort_if(Gate::denies('student_moodle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentMoodles.edit', compact('studentMoodle'));
    }

    public function update(UpdateStudentMoodleRequest $request, StudentMoodle $studentMoodle)
    {
        $studentMoodle->update($request->all());

        if ($request->input('image', false)) {
            if (!$studentMoodle->image || $request->input('image') !== $studentMoodle->image->file_name) {
                if ($studentMoodle->image) {
                    $studentMoodle->image->delete();
                }
                $studentMoodle->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($studentMoodle->image) {
            $studentMoodle->image->delete();
        }

        return redirect()->route('admin.student-moodles.index');
    }

    public function show(StudentMoodle $studentMoodle)
    {
        abort_if(Gate::denies('student_moodle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentMoodles.show', compact('studentMoodle'));
    }

    public function destroy(StudentMoodle $studentMoodle)
    {
        abort_if(Gate::denies('student_moodle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMoodle->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyStudentMoodleRequest $request)
    {
        StudentMoodle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_moodle_create') && Gate::denies('student_moodle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudentMoodle();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
