<?php

namespace App\Http\Requests;

use App\Models\CancelRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCancelRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cancel_request_create');
    }

    public function rules()
    {
        return [];
    }
}
