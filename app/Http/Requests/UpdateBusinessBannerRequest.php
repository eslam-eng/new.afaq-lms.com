<?php

namespace App\Http\Requests;

use App\Models\BusinessBanner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessBannerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_banner_edit');
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
            //     'nullable',
            //     'min:5','max:10',
            // ],
            // 'short_description_ar' => [
            //     'string',
            //     'required',
            //     'min:5','max:10',
            // ],
        ];
    }
}
