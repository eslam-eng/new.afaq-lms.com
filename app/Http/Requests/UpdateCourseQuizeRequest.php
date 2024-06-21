<?php

namespace App\Http\Requests;

use App\Models\CourseQuize;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseQuizeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_quize_edit');
    }

    public function rules()
    {
        return [

            'exam_title_id' => [
                'required',
                'integer',
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
            'image' => [
                'nullable',
            ],
            'status' => [
                'required',
            ],
            'start_at' => [
                'nullable',
            ],
            'end_at' => [
                'nullable',
            ],
        ];
    }
}
