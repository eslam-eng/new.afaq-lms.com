<?php

namespace App\Http\Requests;

use App\Models\CancelationPolicy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCancelationPolicyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cancelation_policy_create');
    }

    public function rules()
    {
        return [
            'course_id' => [
                'required',
                'integer',
            ],
            'cancelation_policy_values'=> [
                'array',
            ],
            'cancelation_policy_values.*.days' => [
                'string',
                'nullable',
            ],
            'cancelation_policy_values.*.amount' => [
                'numeric',
                'min:0',
            ],

        ];
    }
}
