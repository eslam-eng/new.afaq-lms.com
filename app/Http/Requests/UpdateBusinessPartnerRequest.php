<?php

namespace App\Http\Requests;

use App\Models\BusinessPartner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessPartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_partner_edit');
    }

    public function rules()
    {
        return [
            'title_en' => [
                'string',

            ],
            'title_ar' => [
                'string',

            ],
        ];
    }
}
