<?php

namespace App\Http\Requests;

use App\Models\CancelPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCancelPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cancel_payment_edit');
    }

    public function rules()
    {
        return [];
    }
}
