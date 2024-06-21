<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTicketCommentRequest;
use App\Http\Requests\StoreTicketCommentRequest;
use App\Http\Requests\UpdateTicketCommentRequest;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketCommentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ticket_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticketComments = TicketComment::with(['user', 'ticket'])->get();

        return view('admin.ticketComments.index', compact('ticketComments'));
    }

    public function create()
    {
        abort_if(Gate::denies('ticket_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('approved',1)->where('verified',1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = Ticket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ticketComments.create', compact('tickets', 'users'));
    }

    public function store(StoreTicketCommentRequest $request)
    {
        $ticketComment = TicketComment::create($request->all());

        return redirect()->route('admin.ticket-comments.index');
    }

    public function edit(TicketComment $ticketComment)
    {
        abort_if(Gate::denies('ticket_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('approved',1)->where('verified',1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = Ticket::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ticketComment->load('user', 'ticket');

        return view('admin.ticketComments.edit', compact('ticketComment', 'tickets', 'users'));
    }

    public function update(UpdateTicketCommentRequest $request, TicketComment $ticketComment)
    {
        $ticketComment->update($request->all());

        return redirect()->route('admin.ticket-comments.index');
    }

    public function show(TicketComment $ticketComment)
    {
        abort_if(Gate::denies('ticket_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticketComment->load('user', 'ticket');

        return view('admin.ticketComments.show', compact('ticketComment'));
    }

    public function destroy(TicketComment $ticketComment)
    {
        abort_if(Gate::denies('ticket_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticketComment->delete();

        return back();
    }

    public function massDestroy(MassDestroyTicketCommentRequest $request)
    {
        $ticketComments = TicketComment::find(request('ids'));

        foreach ($ticketComments as $ticketComment) {
            $ticketComment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
