<?php

namespace App\Http\Requests;

use App\Models\AttendanceDesignKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAttendanceDesignKeyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendance_design_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:attendance_design_keys,id',
        ];
    }
}
