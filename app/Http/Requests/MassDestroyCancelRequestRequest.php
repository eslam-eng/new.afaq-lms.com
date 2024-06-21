<?php

namespace App\Http\Requests;

use App\Models\CancelRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCancelRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cancel_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cancel_requests,id',
        ];
    }
}
