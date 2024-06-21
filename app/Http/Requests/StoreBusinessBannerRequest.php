<?php

namespace App\Http\Requests;

use App\Models\BusinessBanner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessBannerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_banner_create');
    }

    public function rules()
    {
        return [
            'title_en' => [
                'string',
                'nullable',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
            'description_ar' => [
                'required',
            ],
            // 'short_description_en' => [
            //     'string',
            //     'min:5','max:10',
            //     'nullable',
            // ],
            // 'short_description_ar' => [
            //     'string',
            //     'min:5','max:10',
            //     'required',
            // ],
        ];
    }
}
