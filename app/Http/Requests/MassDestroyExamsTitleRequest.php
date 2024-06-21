<?php

namespace App\Http\Requests;

use App\Models\ExamsTitle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExamsTitleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exams_title_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:exams_titles,id',
        ];
    }
}
