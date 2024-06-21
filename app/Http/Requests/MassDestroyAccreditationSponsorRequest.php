<?php

namespace App\Http\Requests;

use App\Models\AccreditationSponsor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccreditationSponsorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accreditation_sponsor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:accreditation_sponsors,id',
        ];
    }
}
