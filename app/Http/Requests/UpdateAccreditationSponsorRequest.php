<?php

namespace App\Http\Requests;

use App\Models\AccreditationSponsor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAccreditationSponsorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accreditation_sponsor_edit');
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
            'logo' => [
                'required',
            ],
        ];
    }
}
