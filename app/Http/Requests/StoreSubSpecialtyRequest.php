<?php

namespace App\Http\Requests;

use App\Models\SubSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_specialty_create');
    }

    public function rules()
    {
        return [
            'specialty_id' => [
                'required',
                'integer',
            ],
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'nullable',
            ],
        ];
    }
}
