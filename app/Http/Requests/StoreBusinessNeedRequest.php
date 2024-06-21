<?php

namespace App\Http\Requests;

use App\Models\BusinessNeed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessNeedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_need_create');
    }

    public function rules()
    {
        return [
//            'text_en' => [
//                'string',
//                'required',
//            ],
//            'text_ar' => [
//                'string',
//                'required',
//            ],
//            'description_en' => [
//                'required',
//            ],
//            'description_ar' => [
//                'required',
//            ],
            'short_description_en' => [
                'string',
                'nullable',
            ],
            'short_description_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
