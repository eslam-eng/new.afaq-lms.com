<?php

namespace App\Http\Requests;

use App\Models\IconTextDe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIconTextDeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('icon_text_de_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:icon_text_des,id',
        ];
    }
}
