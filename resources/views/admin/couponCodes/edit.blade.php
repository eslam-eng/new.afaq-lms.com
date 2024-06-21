@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.couponCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coupon-codes.update", [$couponCode->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.couponCode.fields.course') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id[]" id="course_id" multiple required>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ in_array( $id, $course_coupon_selected_array)  ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach

                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coupon_text">{{ trans('cruds.couponCode.fields.coupon_text') }}</label>
                <input class="form-control {{ $errors->has('coupon_text') ? 'is-invalid' : '' }}" type="text" name="coupon_text" id="coupon_text" value="{{ old('coupon_text', $couponCode->coupon_text) }}" required>
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
                        <option value="{{ $key }}" {{ old('coupon_type', $couponCode->coupon_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <input class="form-control {{ $errors->has('coupon_amount') ? 'is-invalid' : '' }}" type="number" name="coupon_amount" id="coupon_amount" value="{{ old('coupon_amount', $couponCode->coupon_amount) }}" step="0.01" required>
                @if($errors->has('coupon_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coupon_expire_date">{{ trans('cruds.couponCode.fields.coupon_expire_date') }}</label>
                <input class="form-control date {{ $errors->has('coupon_expire_date') ? 'is-invalid' : '' }}" type="date" name="coupon_expire_date" id="coupon_expire_date" value="{{ old('coupon_expire_date', date('Y-m-d',strtotime($couponCode->coupon_expire_date))) }}" required>
                @if($errors->has('coupon_expire_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coupon_expire_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.couponCode.fields.coupon_expire_date_helper') }}</span>
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
