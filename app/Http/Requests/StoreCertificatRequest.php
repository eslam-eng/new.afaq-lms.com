<?php

namespace App\Http\Requests;

use App\Models\Certificat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCertificatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('certificat_create');
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
            'image' => [
                'required','image','mimes:jpg,png,jpeg,gif,svg'
            ],
            'templete' => [
                'nullable',
            ],
        ];
    }
}
