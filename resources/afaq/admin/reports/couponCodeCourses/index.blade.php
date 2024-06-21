@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }}   {{ trans('cruds.couponCode.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CouponCode">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponCode.fields.coupon_expire_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.couponCode.fields.use_count') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($couponCodes as $key => $couponCode)
                    <tr data-entry-id="{{ $couponCode->id }}">
                        <td></td>
                        <td>
                            {{ $couponCode->id ?? '' }}
                        </td>
                        <td>
                            {{ $couponCode->coupon_text ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\CouponCode::COUPON_TYPE_SELECT[$couponCode->coupon_type] ?? '' }}
                        </td>
                        <td>
                            {{ $couponCode->coupon_amount ?? '' }}
                        </td>
                        <td>
                            {{ $couponCode->coupon_expire_date ?? '' }}
                        </td>
                        <td>
                            {{ $couponCode->enrolles_count ?? 0 }}
                        </td>
                        <td>
                            <a href="{{ route('admin.coupon-code-courses.show', $couponCode->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                {{ trans('cruds.courseInvoice.fields.courses') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
