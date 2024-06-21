<?php

namespace App\Http\Requests;

use App\Models\Instructor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstructorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instructor_edit');
    }

    public function rules()
    {
        return [
            'name_ar' => [
                'string',
                'required',
            ],
            'name_en' => [
                'string',
                'required',
            ],
            'bio_ar' => [
                'string',
                'required',
            ],
            'bio_en' => [
                'string',
                'required',
            ],
            'mail' => [
                'string',
                'required', 'email'
            ],
            'password' => [
//                'required',
            ],
            'mobile' => [
                'string',
                'required',
            ],
            'image' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000'
        ];
    }
}
