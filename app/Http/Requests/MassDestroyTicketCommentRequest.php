<?php

namespace App\Http\Requests;

use App\Models\TicketComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTicketCommentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ticket_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ticket_comments,id',
        ];
    }
}
