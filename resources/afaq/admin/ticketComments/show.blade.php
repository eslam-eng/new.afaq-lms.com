@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticketComment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ticket-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.id') }}
                        </th>
                        <td>
                            {{ $ticketComment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.user') }}
                        </th>
                        <td>
                            {{ $ticketComment->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.ticket') }}
                        </th>
                        <td>
                            {{ $ticketComment->ticket->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.author_name') }}
                        </th>
                        <td>
                            {{ $ticketComment->author_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.author_email') }}
                        </th>
                        <td>
                            {{ $ticketComment->author_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketComment.fields.comment_text') }}
                        </th>
                        <td>
                            {{ $ticketComment->comment_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TicketComment::TYPE_SELECT[$ticketComment->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.image') }}
                        </th>

                        <td>
                            @if($ticketComment->image)
{{--                                <a href="{{ url('storage/'.$ticketComment->image) }}" target="_blank"  style="display: inline-block">--}}
{{--                                    <img src="{{ url('storage/'.$ticketComment->image) }}" alt="" height="150" width="150">--}}
{{--                                </a>--}}
                                <img src="{{ url('storage/'.$ticketComment->image) }}" alt="" title="" width="500" height="400" />

                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ticket-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
