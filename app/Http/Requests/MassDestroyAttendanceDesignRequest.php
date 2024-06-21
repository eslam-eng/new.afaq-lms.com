<?php

namespace App\Http\Requests;

use App\Models\AttendanceDesign;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAttendanceDesignRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendance_design_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:attendance_designs,id',
        ];
    }
}
