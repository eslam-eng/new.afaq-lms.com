<?php

namespace App\Http\Requests;

use App\Models\BusinessFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_feature_create');
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
        ];
    }
}
