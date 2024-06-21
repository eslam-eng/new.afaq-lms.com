<?php

namespace App\Http\Requests;

use App\Models\CouponCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCouponCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_code_edit');
    }

    public function rules()
    {
        return [
            'coupon_text' => [
                'string',
                'required',
            ],
            'coupon_type' => [
                'required',
            ],
            'coupon_amount' => [
                'numeric',
                'required',
            ],
            'coupon_expire_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
