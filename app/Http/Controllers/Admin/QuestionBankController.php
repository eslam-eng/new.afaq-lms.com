<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuestionBankRequest;
use App\Http\Requests\StoreQuestionBankRequest;
use App\Http\Requests\UpdateQuestionBankRequest;
use App\Models\ExamsTitle;
use App\Models\QuestionAnswer;
use App\Models\QuestionBank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionBankController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('question_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionBanks = QuestionBank::with(['exam_title'])->orderBy('id', 'desc')->get();

        return view('admin.questionBanks.index', compact('questionBanks'));
    }

    public function create()
    {
        abort_if(Gate::denies('question_bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.questionBanks.create', compact('exam_titles'));
    }

    public function store(StoreQuestionBankRequest $request)
    {
        $questionBank = QuestionBank::create($request->all());
        $question_banks_id = $questionBank->id;


        if (isset($request->answer) && isset($request->correct_answer)) {
            foreach ($request->answer as $key => $value) {
                $master = $request->correct_answer == $key ? 1 : 0;
                $data[$key] = [
                    'question_banks_id' => $question_banks_id,
                    'answer' => $request->answer[$key],
                    'correct_answer' => $master
                ];
            }
            QuestionAnswer::insert($data);
        }


        return redirect()->route('admin.question-banks.index');
    }

    public function edit(QuestionBank $questionBank)
    {
        abort_if(Gate::denies('question_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam_titles = ExamsTitle::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questionBank->load('exam_title' ,'bank_answer');

        return view('admin.questionBanks.edit', compact('exam_titles', 'questionBank'));
    }

    public function update(UpdateQuestionBankRequest $request, QuestionBank $questionBank)
    {
        $questionBank->update($request->all());
        QuestionAnswer::where('question_banks_id', $questionBank->id)->delete();
        if (isset($request->answer) && isset($request->correct_answer)) {
            foreach ($request->answer as $key => $value) {
                $master = $request->correct_answer == $key ? 1 : 0;
                $data[$key] = [
                    'question_banks_id' => $questionBank->id,
                    'answer' => $request->answer[$key],
                    'correct_answer' => $master
                ];
            }
            QuestionAnswer::insert($data);
        }
        return redirect()->route('admin.question-banks.index');
    }

    public function show(QuestionBank $questionBank)
    {
        abort_if(Gate::denies('question_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionBank->load('exam_title');

        return view('admin.questionBanks.show', compact('questionBank'));
    }

    public function destroy(QuestionBank $questionBank)
    {
        abort_if(Gate::denies('question_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionBank->delete();
        $questionBank->bank_answer()->delete();

        return back()->with('message', __('global.delete_account_success'));
    }
    public function massDestroy(MassDestroyQuestionBankRequest $request)
    {
        QuestionBank::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
