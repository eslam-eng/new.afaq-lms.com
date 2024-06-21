<?php

namespace App\Http\Requests;

use App\Models\PointTypeValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointTypeValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_type_value_create');
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
                'min:-2147483648',
                'max:2147483647',
            ],
            'get_point' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
