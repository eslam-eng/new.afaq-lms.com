@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseInvoice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-invoices.index') }}">
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
                            {{ $courseInvoice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.invoice') }}
                        </th>
                        <td>
                            {{ $courseInvoice->invoice_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $courseInvoice->pay_method ? $courseInvoice->pay_method->name : $courseInvoice->bank->name  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.bank') }}
                        </th>
                        <td>
                            {{ $courseInvoice->bank->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.amount') }}
                        </th>
                        <td>
                            {{ $courseInvoice->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.currency') }}
                        </th>
                        <td>
                            {{ $courseInvoice->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.date') }}
                        </th>
                        <td>
                            {{ $courseInvoice->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.bank_name') }}
                        </th>
                        <td>
                            {{ $courseInvoice->bank_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.bank_number') }}
                        </th>
                        <td>
                            {{ $courseInvoice->bank_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.invoice_image') }}
                        </th>
                        <td>
                            @if($courseInvoice->invoice_image)
                                <a href="{{ $courseInvoice->invoice_image->url }}" target="_blank" style="display: inline-block" >
                                    <img src="{{ $courseInvoice->invoice_image->url }}">
                                </a>
                                <a class="btn btn-success waves-effect waves-light" href="{{ $courseInvoice->invoice_image->url  }}" download>Download here!</a>
                            @endif
                        </td>

                    </tr>
                    <tr>

                        <td>
{{--                            <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">--}}
{{--                                <input type="checkbox" class="custom-control-input" id="approved{{$payment->id }}" data-id="{{$payment->id}}" onchange="change_approve({{$payment->id}})" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="Un Approve" data-on="Approve" {{$payment->approved == true ? 'checked' : '' }}>--}}
{{--                                <label class="custom-control-label" for="approved{{$payment->id}}">--}}
{{--                                    <span class="switch-text-right">لم يتم الدفع</span>--}}
{{--                                    <span class="switch-text-left">تم الدفع</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-invoices.index') }}">
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

        {{--Order Payment --}}
        <li class="nav-item">
            <a class="nav-link active" href="#order_payment" role="tab" data-toggle="tab">
                {{ trans('cruds.reservation.fields.payment_details') }}
            </a>
        </li>
        {{--Course Payment --}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#course_payment" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.reservation.fields.course_payments') }}--}}
{{--            </a>--}}
{{--        </li>--}}
        {{--Users --}}
        <li class="nav-item">
            <a class="nav-link" href="#users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        {{--Courses --}}
        <li class="nav-item">
            <a class="nav-link" href="#courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>

    </ul>
    <div class="tab-content">
        {{--Order Payment--}}
        <div class="tab-pane active" role="tabpanel" id="order_payment">
            @includeIf('admin.courseInvoices.relationships.payment_details', ['reservation_payments' => $courseInvoice->ReaservationCourse])
        </div>

        {{--Users --}}
        <div class="tab-pane" role="tabpanel" id="users">
            @includeIf('admin.courseInvoices.relationships.User_Data', ['users' => $courseInvoice->user])
        </div>
        {{--  Courses--}}
        <div class="tab-pane" role="tabpanel" id="courses">
            @includeIf('admin.courseInvoices.relationships.course_data', ['courses' => $courseInvoice->courses])
        </div>

    </div>
</div>


@endsection
@section('scripts')

{{--<script>--}}
{{--    function change_approve(id) {--}}
{{--        var approved = $("#approved").prop('checked') == true ? 1 : 0;--}}
{{--        var reservation_id = id;--}}
{{--        $.ajax({--}}
{{--            type: "GET",--}}
{{--            dataType: "json",--}}
{{--            url: '/admin/ChangeStatusReservation',--}}
{{--            data: {--}}
{{--                'approved': approved,--}}
{{--                'reservation_id': reservation_id--}}
{{--            },--}}
{{--            success: function(data) {}--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
@endsection
