<?php

namespace App\Http\Requests;

use App\Models\SliderCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSliderCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_card_edit');
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
            'description_en' => [
                'nullable',
            ],
            'description_ar' => [
                'nullable',
            ],
        ];
    }
}
