<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExamsTitleRequest;
use App\Http\Requests\StoreExamsTitleRequest;
use App\Http\Requests\UpdateExamsTitleRequest;
use App\Models\ExamsTitle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamsTitleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('exams_title_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examsTitles = ExamsTitle::orderBy('created_at', 'asc')->get();

        return view('admin.examsTitles.index', compact('examsTitles'));
    }

    public function create()
    {
//        abort_if(Gate::denies('exams_title_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examsTitles.create');
    }

    public function store(StoreExamsTitleRequest $request)
    {
//        dd($request->toArray());
        $examsTitle = ExamsTitle::create($request->all());

        return redirect()->route('admin.exams-titles.index');
    }

    public function edit(ExamsTitle $examsTitle)
    {
        abort_if(Gate::denies('exams_title_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examsTitles.edit', compact('examsTitle'));
    }

    public function update(UpdateExamsTitleRequest $request, ExamsTitle $examsTitle)
    {
        $examsTitle->update($request->all());

        return redirect()->route('admin.exams-titles.index');
    }

    public function show(ExamsTitle $examsTitle)
    {
        abort_if(Gate::denies('exams_title_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examsTitles.show', compact('examsTitle'));
    }

    public function destroy(ExamsTitle $examsTitle)
    {
        abort_if(Gate::denies('exams_title_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examsTitle->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyExamsTitleRequest $request)
    {
        ExamsTitle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
