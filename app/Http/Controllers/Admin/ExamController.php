<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExamRequest;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Certificat;
use App\Models\Exam;
use App\Models\ExamsTitle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('exam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exams = Exam::with(['certificate', 'media'])->get();

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        abort_if(Gate::denies('exam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $certificates = Certificat::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('admin.exams.create', compact('certificates', 'exam_titles'));
    }

    public function store(StoreExamRequest $request)
    {
        try {
            $exam_question_count = ExamsTitle::whereIn('id', $request->exams_title_id)->first()->questions()->count();

            if ($request->number_question > $exam_question_count) {
                return back()->with('error', 'number of question should be less or equal ' . $exam_question_count);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $exam = Exam::create($request->all());

        if ($request->input('image', false)) {
            $exam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $exam->id]);
        }

        $exam->create_exam_exam_title()->sync($request->exams_title_id);
        return redirect()->route('admin.exams.index');
    }

    public function edit(Exam $exam)
    {
        abort_if(Gate::denies('exam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id');

        $certificates = Certificat::pluck('name_' . app()->getLocale() . ' as name', 'id');

        $exam->load('certificate');

        $exam_exam_content_selected_array =  $exam->create_exam_exam_title->pluck('pivot.exams_title_id')->toArray();


        return view('admin.exams.edit', compact('certificates', 'exam', 'exam_titles', 'exam_exam_content_selected_array'));
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        try {
            $exam_question_count = ExamsTitle::whereIn('id', $request->exams_title_id)->first()->questions()->count();

            if ($request->number_question > $exam_question_count) {
                return back()->with('error', 'number of question should be less or equal ' . $exam_question_count);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $exam->update($request->all());

        if ($request->input('image', false)) {
            if (!$exam->image || $request->input('image') !== $exam->image->file_name) {
                if ($exam->image) {
                    $exam->image->delete();
                }
                $exam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($exam->image) {
            $exam->image->delete();
        }
        $exam->create_exam_exam_title()->sync($request->exams_title_id);


        return redirect()->route('admin.exams.index');
    }

    public function show(Exam $exam)
    {
        abort_if(Gate::denies('exam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam->load('certificate');

        return view('admin.exams.show', compact('exam'));
    }

    public function destroy(Exam $exam)
    {
        abort_if(Gate::denies('exam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyExamRequest $request)
    {
        Exam::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('exam_create') && Gate::denies('exam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Exam();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
