<?php

namespace App\Http\Requests;

use App\Models\PointType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_type_edit');
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
                'nullable',
            ],
            'key' => [
                'string',
                'nullable',
            ],
        ];
    }
}
