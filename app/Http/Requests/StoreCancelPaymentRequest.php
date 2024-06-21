<?php

namespace App\Http\Requests;

use App\Models\CancelPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCancelPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cancel_payment_create');
    }

    public function rules()
    {
        return [];
    }
}
