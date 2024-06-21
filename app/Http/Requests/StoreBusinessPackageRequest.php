<?php

namespace App\Http\Requests;

use App\Models\BusinessPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_package_create');
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
            // 'price_package_annual' => [
            //     'string',
            //     'required',
            // ],
            // 'package_annual_price_offers' => [
            //     'string',
            //     'nullable',
            // ],
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
        ];
    }
}
