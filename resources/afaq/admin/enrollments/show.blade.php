@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enrollment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enrollments.index') }}">
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
                            {{ $enrollment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.user') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ?  $enrollment->user->full_name_en ?? '' : $enrollment->user->full_name_ar ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.course') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ?  $enrollment->course->name_en ?? '' : $enrollment->course->name_en ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.start_at') }}
                        </th>
                        <td>
                            {{ $enrollment->course->start_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.end_at') }}
                        </th>
                        <td>
                            {{ $enrollment->course->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.enrolled_at') }}
                        </th>
                        <td>
                            {{ $enrollment->enroll->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.coupon') }}
                        </th>
                        <td>
                            {{ $enrollment->enroll->coupon }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.coupon_discount') }}
                        </th>
                        <td>
                            {{ $enrollment->enroll->coupon_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.final_total') }}
                        </th>
                        <td>
                            {{ $enrollment->enroll->final_total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enrollments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>

    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">

        {{--Enroll Payment --}}
        <li class="nav-item">
            <a class="nav-link" href="#enroll_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.enrollment.fields.enroll_payments') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        {{--Order Payment--}}
        <div class="tab-pane" role="tabpanel" id="enroll_payments">
            @includeIf('admin.enrollments.relationships.enroll_payments', ['enrollment_payments' => $enrollment->enroll->enroll_payment])
        </div>


    </div>
</div>


@endsection
