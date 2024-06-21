<?php

namespace App\Http\Requests;

use App\Models\PointAction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointActionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_action_edit');
    }

    public function rules()
    {
        return [];
    }
}
