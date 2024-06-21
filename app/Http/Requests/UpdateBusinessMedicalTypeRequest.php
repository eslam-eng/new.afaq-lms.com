<?php

namespace App\Http\Requests;

use App\Models\BusinessMedicalType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessMedicalTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_medical_type_edit');
    }

    public function rules()
    {
        return [
            'medical_header_en' => [
                'string',
                'nullable',
            ],
            'medical_header_ar' => [
                'string',
                'nullable',
            ],
            'title_en' => [
                'string',
                'required',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
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
