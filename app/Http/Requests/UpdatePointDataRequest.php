<?php

namespace App\Http\Requests;

use App\Models\PointData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_data_edit');
    }

    public function rules()
    {
        return [];
    }
}
