@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.couponCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coupon-codes.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.course.title_singular') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id[]" id="course_id[]" required multiple>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label class="required" for="coupon_text">{{ trans('cruds.couponCode.fields.coupon_text') }}</label>
                <input class="form-control {{ $errors->has('coupon_text') ? 'is-invalid' : '' }}" type="text" name="coupon_text" id="coupon_text" value="{{ old('coupon_text', '') }}" required>
                @if($errors->has('coupon_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.couponCode.fields.coupon_type') }}</label>
                <select class="form-control {{ $errors->has('coupon_type') ? 'is-invalid' : '' }}" name="coupon_type" id="coupon_type" required>
                    <option value disabled {{ old('coupon_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CouponCode::COUPON_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('coupon_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('coupon_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coupon_amount">{{ trans('cruds.couponCode.fields.coupon_amount') }}</label>
                <input class="form-control {{ $errors->has('coupon_amount') ? 'is-invalid' : '' }}" type="number" name="coupon_amount" id="coupon_amount" value="{{ old('coupon_amount', '') }}" step="0.01" required>
                @if($errors->has('coupon_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coupon_expire_date">{{ trans('cruds.couponCode.fields.coupon_expire_date') }}</label>
                <input class="form-control date {{ $errors->has('coupon_expire_date') ? 'is-invalid' : '' }}" type="date" pattern="\d{2}-\d{4}-\d{2}" name="coupon_expire_date" id="coupon_expire_date" value="{{ old('coupon_expire_date') }}" required>
                @if($errors->has('coupon_expire_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_expire_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_expire_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coupon_use_number">{{ trans('cruds.couponCode.fields.coupon_use_number') }}</label>
                <input class="form-control {{ $errors->has('coupon_use_number') ? 'is-invalid' : '' }}" type="number" name="coupon_use_number" id="coupon_use_number" value="{{ old('coupon_use_number', '') }}" step="1">
                @if($errors->has('coupon_use_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_use_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_use_number_helper') }}</span>
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
