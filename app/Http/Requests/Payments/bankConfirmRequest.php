<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class bankConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "invoice_id" => "required|unique:bank_invoices,invoice_id",
            "payment_method_id" => "required|exists:payment_methods,id",
            "amount" => "required|numeric",
            "currency" => "required|string",
//            "date" => "required|date",
            'date' => ['required', 'before_or_equal:' . now()->format('Y-m-d')],

            "bank_id" => "required|exists:bank_lists,id",
            "bank_name" => "required|string",
            "bank_number" => "required|string",
            "invoice_image" => "required|file|mimes:jpeg,png,jpg",
        ];
    }
    public function messages()
    {
        return [
            'bank_name.required' => trans('cruds.courseInvoice.fields.bank_name'),
            'bank_number.required' => trans('cruds.courseInvoice.fields.bank_number'),
            'date.required' => trans('cruds.payment.fields.date'),
            'invoice_image.required' => trans('cruds.courseInvoice.fields.invoice_imaged'),


        ];
    }
}
