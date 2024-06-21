<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_method_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'required',
            ],

            'provider_method' => [
                'nullable',
                'integer',

            ],
            'service_fees' => [
                'numeric',
            ],
            'mode' => [
                'string',
                'nullable',
            ],
        ];
    }
}
