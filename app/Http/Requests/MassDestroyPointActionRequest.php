<?php

namespace App\Http\Requests;

use App\Models\PointAction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointActionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_action_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_actions,id',
        ];
    }
}
