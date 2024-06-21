<?php

namespace App\Http\Requests;

use App\Models\IconText;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIconTextRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('icon_text_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:icon_texts,id',
        ];
    }
}
