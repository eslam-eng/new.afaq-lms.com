@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.wallet.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wallets.update", [$wallet->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.wallet.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $wallet->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wallet.fields.user_helper') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="email_id">{{ trans('cruds.wallet.fields.email') }}</label>--}}
{{--                <select class="form-control select2 {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email_id" id="email_id">--}}
{{--                    @foreach($emails as $id => $entry)--}}
{{--                        <option value="{{ $id }}" {{ (old('email_id') ? old('email_id') : $wallet->email->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @if($errors->has('email'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('email') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.wallet.fields.email_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="currency">{{ trans('cruds.wallet.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', $wallet->currency) }}">
                @if($errors->has('currency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('currency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wallet.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance">{{ trans('cruds.wallet.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="text" name="balance" id="balance" value="{{ old('balance', $wallet->balance) }}">
                @if($errors->has('balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wallet.fields.balance_helper') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="phone">{{ trans('cruds.wallet.fields.phone') }}</label>--}}
{{--                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $wallet->phone) }}">--}}
{{--                @if($errors->has('phone'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('phone') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.wallet.fields.phone_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <label>{{ trans('cruds.wallet.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Wallet::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $wallet->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wallet.fields.status_helper') }}</span>
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
