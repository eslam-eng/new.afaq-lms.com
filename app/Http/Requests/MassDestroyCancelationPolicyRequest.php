<?php

namespace App\Http\Requests;

use App\Models\CancelationPolicy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCancelationPolicyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cancelation_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cancelation_policies,id',
        ];
    }
}
