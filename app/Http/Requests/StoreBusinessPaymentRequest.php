<?php

namespace App\Http\Requests;

use App\Models\BusinessPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_payment_create');
    }

    public function rules()
    {
        return [
            'package_name_en' => [
                'string',
                'required',
            ],
            'package_name_ar' => [
                'string',
                'required',
            ],
            'price_package_annual' => [
                'string',
                'nullable',
            ],
            'package_annual_price_offers' => [
                'string',
                'nullable',
            ],
            'price_package_month' => [
                'string',
                'required',
            ],
            'package_month_price_offers' => [
                'string',
                'nullable',
            ],
            'event_number' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'speakers_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'attendance_trainees_number' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'remote_trainees_number' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'package' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'payment_method' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'initial_response' => [
                'string',
                'nullable',
            ],
            'status_response' => [
                'string',
                'required',
            ],
            'payment_number' => [
                'string',
                'nullable',
            ],
            'price' => [
                'string',
                'nullable',
            ],
        ];
    }
}
