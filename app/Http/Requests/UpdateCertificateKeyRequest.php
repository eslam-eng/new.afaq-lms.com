<?php

namespace App\Http\Requests;

use App\Models\CertificateKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCertificateKeyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('certificate_key_edit');
    }

    public function rules()
    {
        return [
            'key' => [
                'string',
                'required',
            ],
        ];
    }
}
