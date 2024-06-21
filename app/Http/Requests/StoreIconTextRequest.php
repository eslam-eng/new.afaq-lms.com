<?php

namespace App\Http\Requests;

use App\Models\IconText;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIconTextRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('icon_text_create');
    }

    public function rules()
    {
        return [
            'title_en' => [
                'string',
                'required',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
