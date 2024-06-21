@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.couponCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coupon-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>

            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $couponCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.course') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ? $course->name_en ?? '' : $course->name_ar ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_text') }}
                        </th>
                        <td>
                            {{ $couponCode->coupon_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_type') }}
                        </th>
                        <td>
                            {{ App\Models\CouponCode::COUPON_TYPE_SELECT[$couponCode->coupon_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_amount') }}
                        </th>
                        <td>
                            {{ $couponCode->coupon_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_expire_date') }}
                        </th>
                        <td>
                            {{ $couponCode->coupon_expire_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_use_number') }}
                        </th>
                        <td>
                            {{ $couponCode->coupon_use_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coupon-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
