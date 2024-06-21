<?php

namespace App\Http\Requests;

use App\Models\PointData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:point_datas,id',
        ];
    }
}
