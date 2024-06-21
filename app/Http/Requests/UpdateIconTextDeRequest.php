<?php

namespace App\Http\Requests;

use App\Models\IconTextDe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIconTextDeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icon_text_de_edit');
    }

    public function rules()
    {
        return [
            'text_en' => [
                'string',
                'required',
            ],
            'text_ar' => [
                'string',
                'required',
            ],
            'description_en' => [
                'nullable',
            ],
            'description_ar' => [
                'nullable',
            ],
            'link_en' => [
                'string',
                'required',
            ],
            'link_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
