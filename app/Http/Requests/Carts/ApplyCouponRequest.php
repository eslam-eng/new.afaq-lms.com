<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyCouponRequest extends FormRequest
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
            'coupon_text' => [
                "required", "string", "exists:coupon_codes,coupon_text",
                Rule::exists('coupon_codes')->where(function ($query) {
                    return $query->where('coupon_expire_date', '>', date('Y-m-d', strtotime(now())));
                }),
            ],
            'item_id' => 'nullable|exists:cart_items,id'
        ];
    }
}
