<?php

namespace App\Http\Requests;

use App\Models\PointData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_data_create');
    }

    public function rules()
    {
        return [];
    }
}
