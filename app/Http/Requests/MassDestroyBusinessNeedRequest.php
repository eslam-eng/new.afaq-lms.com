<?php

namespace App\Http\Requests;

use App\Models\BusinessNeed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessNeedRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_need_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_needs,id',
        ];
    }
}
