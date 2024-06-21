<?php

namespace App\Http\Requests;

use App\Models\UserMembership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserMembershipRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_memberships,id',
        ];
    }
}
