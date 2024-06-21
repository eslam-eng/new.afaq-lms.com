@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ticketComment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ticket-comments.update", [$ticketComment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.ticketComment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $ticketComment->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticketComment.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ticket_id">{{ trans('cruds.ticketComment.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id">
                    @foreach($tickets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ticket_id') ? old('ticket_id') : $ticketComment->ticket->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ticket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticketComment.fields.ticket_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_name">{{ trans('cruds.ticketComment.fields.author_name') }}</label>
                <input class="form-control {{ $errors->has('author_name') ? 'is-invalid' : '' }}" type="text" name="author_name" id="author_name" value="{{ old('author_name', $ticketComment->author_name) }}">
                @if($errors->has('author_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticketComment.fields.author_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="author_email">{{ trans('cruds.ticketComment.fields.author_email') }}</label>
                <input class="form-control {{ $errors->has('author_email') ? 'is-invalid' : '' }}" type="text" name="author_email" id="author_email" value="{{ old('author_email', $ticketComment->author_email) }}">
                @if($errors->has('author_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticketComment.fields.author_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment_text">{{ trans('cruds.ticketComment.fields.comment_text') }}</label>
                <input class="form-control {{ $errors->has('comment_text') ? 'is-invalid' : '' }}" type="text" name="comment_text" id="comment_text" value="{{ old('comment_text', $ticketComment->comment_text) }}">
                @if($errors->has('comment_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticketComment.fields.comment_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.blog.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TicketComment::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $ticketComment->type) === (string) $key ? 'selected' : '' }}>{{ trans('afaq.'.$label)  }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
