<?php

namespace App\Http\Requests;

use App\Models\PointTypeValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointTypeValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_type_value_edit');
    }

    public function rules()
    {
        return [
            'point_type_id' => [
                'required',
                'integer',
            ],
            'give_point' => [
                'required',
                'integer',

            ],
            'get_point' => [
                'nullable',
                'integer',

            ],
            'status' => [
                'required',
            ],
        ];
    }
}
