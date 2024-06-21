<?php

namespace App\Http\Requests;

use App\Models\Exam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('exam_edit');
    }

    public function rules()
    {
        return [
            'exams_title_id' => [
//                'required',

            ],
            'title_en' => [
                'string',
                'nullable',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
            'description_ar' => [
                'required',
            ],
            'success_percentage' => [
                'numeric',
                'required',
            ],
            'certificate_id' => [
                'nullable',

            ],
            'number_question' => [
                'required',
                'numeric',
            ],
            'price' => [

                'numeric',
                'required',
            ],
            'start_at' => [
                'required',
                'before:end_at'
            ],
            'end_at' => [
                'required',
               'after:start_at'
            ],
            'image' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
