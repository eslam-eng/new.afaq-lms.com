<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMembershipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('membership_edit');
    }

    public function rules()
    {
        return [
            'membership_type_id' => [
                'required',
                'integer',
            ],
            'time_type' => [
                'required',
            ],
            'price' => [
                'required',
                'integer',

            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
