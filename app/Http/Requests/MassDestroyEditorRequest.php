<?php

namespace App\Http\Requests;

use App\Models\Editor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEditorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('editor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:editors,id',
        ];
    }
}
