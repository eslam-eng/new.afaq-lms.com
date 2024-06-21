<?php

namespace App\Http\Requests;

use App\Models\CourseConfigration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseConfigrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_configration_create');
    }

    public function rules()
    {
        return [
            'key' => [
                'string',
                'required',
            ],
            'value' => [
                'string',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
