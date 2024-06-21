<?php

namespace App\Http\Requests;

use App\Models\CancelPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCancelPaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cancel_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cancel_payments,id',
        ];
    }
}
