<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseQuestionaireRequest extends FormRequest
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
            'questionaire_id' => 'required|exists:course_questionaire,id',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'questions' => 'required|array',
            'questions.*.title_en' => 'required|string',
            'questions.*.title_ar' => 'required|string',
            'questions.*.type' => ['required', Rule::in(['multi_select', 'select', 'text', 'true_false'])],
            'questions.*.answars' => 'nullable|array',
            'questions.*.answars.*.title_en' => 'nullable|string',
            'questions.*.answars.*.title_ar' => 'nullable|string',
        ];
    }
}
