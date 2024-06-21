<?php

namespace App\Http\Requests;

use App\Models\UserAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_attendances,id',
        ];
    }
}
