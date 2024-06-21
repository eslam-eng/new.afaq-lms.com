<?php

namespace App\Http\Requests;

use App\Models\CouponCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCouponCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_code_create');
    }

    public function rules()
    {
       // dd(request()->all());
        $now = date('Y-m-d', strtotime(now()));

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
                'after:'.$now
                // 'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
