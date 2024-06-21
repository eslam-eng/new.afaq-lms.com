<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'email' => [
                'nullable',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'ticket_category_id' => [
                'nullable',
                'integer',
            ],
            'replies_number' => [
                'nullable',
                'integer',

            ],
        ];
    }
}
