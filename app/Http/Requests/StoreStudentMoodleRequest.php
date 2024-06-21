<?php

namespace App\Http\Requests;

use App\Models\StudentMoodle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentMoodleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_moodle_create');
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
                'unique:student_moodles',
            ],
            'password' => [
                'required',
            ],
            'mobile' => [
                'string',
                'required',
            ],
        ];
    }
}
