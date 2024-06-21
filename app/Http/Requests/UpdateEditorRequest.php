<?php

namespace App\Http\Requests;

use App\Models\Editor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEditorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('editor_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:editors,email,' . request()->route('editor')->id,
            ],
            'mobile' => [
                'string',
                'required',
            ],
        ];
    }
}
