<?php

namespace App\Http\Requests;

use App\Models\BusinessPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessPaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_payments,id',
        ];
    }
}
