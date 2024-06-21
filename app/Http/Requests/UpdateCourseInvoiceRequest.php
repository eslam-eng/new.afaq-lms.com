<?php

namespace App\Http\Requests;

use App\Models\CourseInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_invoice_edit');
    }

    public function rules()
    {
        return [
            'invoice_id' => [
                'required',
            ],
            'courses_ids' => [
                'required',
                'array',
            ],
            'payment_method' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'bank_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'numeric',
            ],
            'currency' => [
                'string',
                'nullable',
            ],
            'date' => [
                'nullable',
            ],
            'bank_name' => [
                'string',
                'nullable',
            ],
            'bank_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
