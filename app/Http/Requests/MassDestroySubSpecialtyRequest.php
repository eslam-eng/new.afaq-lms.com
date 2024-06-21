<?php

namespace App\Http\Requests;

use App\Models\SubSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sub_specialties,id',
        ];
    }
}
