<?php

namespace App\Http\Requests;

use App\Models\CourseInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_invoice_create');
    }

    public function rules()
    {
        return [
            'payment_method_id' => [
                'required',
                'integer',
            ],
            'bank_id' => [
                'nullable',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'courses_ids' => [
                'required',
                'array',
            ],
            'amount' => [
                // 'numeric',
                'required'
            ],
            'currency' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
            ],
            'bank_name' => [
                'required_if:bank_id,==,4',
                'string',
                'nullable',
            ],
            'bank_number' => [
                'required_if:bank_id,==,4',
                'nullable',
            ],
        ];
    }
    public function messages()
    {
        return [
            'bank_name.required' => trans('cruds.courseInvoice.fields.bank_name'),
            'bank_number.required' => trans('cruds.courseInvoice.fields.bank_number'),
        ];
    }

}
