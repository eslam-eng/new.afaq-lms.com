<?php

namespace App\Http\Requests;

use App\Models\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hospital_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
        ];
    }
}
