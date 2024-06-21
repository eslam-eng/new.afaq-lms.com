<?php

namespace App\Http\Requests;

use App\Models\QuestionBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuestionBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_bank_edit');
    }

    public function rules()
    {
        return [
            'exams_title_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
            'answer' => [
                'required',
            ],
            'correct_answer' => [
                'required',
            ],
        ];
    }
}
