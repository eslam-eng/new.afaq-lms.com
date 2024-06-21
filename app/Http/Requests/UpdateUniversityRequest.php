<?php

namespace App\Http\Requests;

use App\Models\University;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUniversityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('university_edit');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
