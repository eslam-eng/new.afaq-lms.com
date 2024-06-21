<?php

namespace App\Http\Requests;

use App\Models\BusinessMedicalType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessMedicalTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_medical_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_medical_types,id',
        ];
    }
}
