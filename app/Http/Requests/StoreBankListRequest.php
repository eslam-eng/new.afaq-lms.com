<?php

namespace App\Http\Requests;

use App\Models\BankList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBankListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_list_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
