<?php

namespace App\Http\Requests;

use App\Models\Exam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('exam_create');
    }

    public function rules()
    {
        $now = date('Y-m-d\TH:i', strtotime(now()));
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

                'required',
                'numeric',
                'max:100',
            ],
            'certificate_id' => [
                'nullable',

            ],
            'number_question' => [
                'required',
                'numeric',
            ],
            'price' => [
                'required',
                'numeric',
            ],

            'start_at' => [
                'required',
               'before:end_at',
               'after:'.$now
            ],
            'end_at' => [
                'required'
                ,'after:start_at'
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
