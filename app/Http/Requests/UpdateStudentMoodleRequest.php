<?php

namespace App\Http\Requests;

use App\Models\StudentMoodle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentMoodleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_moodle_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:student_moodles,email,' . request()->route('student_moodle')->id,
            ],
            'mobile' => [
                'string',
                'required',
            ],
        ];
    }
}
