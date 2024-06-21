<?php

namespace App\Http\Requests;

use App\Models\QuestionBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQuestionBankRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('question_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:question_banks,id',
        ];
    }
}
