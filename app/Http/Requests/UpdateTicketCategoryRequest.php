<?php

namespace App\Http\Requests;

use App\Models\TicketCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTicketCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_category_edit');
    }

    public function rules()
    {
        return [
            'title_en' => [
                'string',
                'required',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
