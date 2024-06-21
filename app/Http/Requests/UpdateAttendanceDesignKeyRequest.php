<?php

namespace App\Http\Requests;

use App\Models\AttendanceDesignKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAttendanceDesignKeyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_design_key_edit');
    }

    public function rules()
    {
        return [
            'key' => [
                'string',
                'required',
            ],
        ];
    }
}
