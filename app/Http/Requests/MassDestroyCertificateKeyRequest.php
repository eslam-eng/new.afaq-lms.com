<?php

namespace App\Http\Requests;

use App\Models\CertificateKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCertificateKeyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('certificate_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:certificate_keys,id',
        ];
    }
}
