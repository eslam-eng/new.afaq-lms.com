<?php

namespace App\Http\Requests;

use App\Models\TicketComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTicketCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_comment_edit');
    }

    public function rules()
    {
        return [
            'author_name' => [
                'string',
                'nullable',
            ],
            'author_email' => [
                'string',
                'nullable',
            ],
            'comment_text' => [
                'string',
                'nullable',
            ],
        ];
    }
}
