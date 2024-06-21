<?php

namespace App\Http\Requests;

use App\Models\UserMembership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserMembershipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_membership_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'numeric',
            ],
            'member_type_id' => [
                'required',
                'numeric',
            ],
            'accreditation_number' => [
                'required',
                'numeric',

            ],
            'start_date' => [
                'required',
                // 'date_format:' . config('panel.date_format'), 'before:end_date'
            ],
            'end_date'   => [
                'required',
                // 'date_format:' . config('panel.date_format'), 'after:start_date'
            ],
        ];
    }
}
