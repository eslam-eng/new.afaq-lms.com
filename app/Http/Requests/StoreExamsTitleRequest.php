<?php

namespace App\Http\Requests;

use App\Models\ExamsTitle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExamsTitleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('exams_title_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'nullable',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
