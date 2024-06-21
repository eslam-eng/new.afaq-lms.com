<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questions' => 'required|array',
            'questions.*' => 'required|array',
            'questions.*.question_id' => 'required|exists:question_banks,id',
            'questions.*.answer_id' => 'required|exists:question_answers,id',
            'questions.*.exams_title_id' => 'required|exists:exams_titles,id',
        ];
    }
}
