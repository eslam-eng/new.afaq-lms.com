<?php

namespace App\Http\Requests;

use App\Models\AttendanceDesign;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAttendanceDesignRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_design_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'nullable',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
            'image' => [
                'required','image','mimes:jpg,png,jpeg,gif,svg'
            ],
            'templete' => [
                'nullable',
            ],
        ];
    }
}
