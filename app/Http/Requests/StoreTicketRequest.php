<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'nullable',
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
