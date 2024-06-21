<?php

namespace App\Http\Requests;

use App\Models\UserAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_attendance_create');
    }

    public function rules()
    {
        return [
            'lecture' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'percentage' => [
                'numeric',
            ],
            'attend_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'leave_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
