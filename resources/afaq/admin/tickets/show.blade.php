@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticket.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.id') }}
                        </th>
                        <td>
                            {{ $ticket->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.user') }}
                        </th>
                        <td>
                            {{ $ticket->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.email') }}
                        </th>
                        <td>
                            {{ $ticket->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.title') }}
                        </th>
                        <td>
                            {{ $ticket->title  ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.category') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ?  $ticket->ticket_category->title_en ?? '' :  $ticket->ticket_category->title_ar ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.replies_number') }}
                        </th>
                        <td>
                            {{ $ticket->replies_number ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.statues') }}
                        </th>
{{--                        <td>--}}
{{--                            {{ App\Models\Ticket::STATUES_SELECT[$ticket->statues] ?? '' }}--}}
{{--                        </td>--}}
                        @if($ticket->statues == "1")
                            <td>
                                {{ trans('cruds.ticket.fields.Resolved')  }}
                            </td>
                        @else
                            <td>
                                {{ trans('cruds.ticket.fields.Opened')  }}
                            </td>
                        @endif

                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.description') }}
                        </th>
                        <td>
                            {{ $ticket->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.created_at') }}
                        </th>
                        <td>
                            {{$ticket->created_at->diffForHumans()}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.updated_at') }}
                        </th>
                        <td>
                            {{$ticket->updated_at->diffForHumans()}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.image') }}
                        </th>
                        <td>

                            @if($ticket->image)
                                <img src="{{ url('storage/'.$ticket->image) }}" alt="" title="" width="500" height="400" />
                            @endif
{{--                            @if($ticket->image)--}}

{{--                                <a class="btn btn-success waves-effect waves-light" href="{{ url('storage/'.$ticket->image)  }}" download>Download here!</a>--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        </td>
                    </tr>
{{--                    {{dd($ticket)}}--}}
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Ticket::TYPE_SELECT[$ticket->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.comments') }}
                        </th>
                        <td>
                            @forelse ($ticket->ticket_comments as $comment)

                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold"><a href="mailto:{{ $comment->user->email }}">{{ $comment->user->name }}</a> ({{ $comment->created_at }})</p>
                                        <p>{{ $comment->comment_text }}</p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col">
                                        @if($comment->image)
                                            <img src="{{ url('storage/'.$comment->image) }}" alt="" title="" width="500" height="400" />
                                        @endif
                                    </div>
                                </div>
                                <hr />
                            @empty
                                <div class="row">
                                    <div class="col">
                                        <p>{{__('lms.no_comments')}}</p>
                                    </div>
                                </div>
                                <hr />
                            @endforelse
                            <form action="{{ route('admin.tickets.storeComment', $ticket->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment_text">{{__('lms.leave_comment')}}</label>
                                    <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
