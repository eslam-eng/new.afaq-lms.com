<?php

namespace App\Http\Requests;

use App\Models\BusinessEventType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessEventTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_event_type_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'nullable',
            ],
            'name_ar' => [
                'string',
                'nullable',
            ],
        ];
    }
}
