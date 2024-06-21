@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.reservation.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reservations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                {{-- {{dd($reservation->payment_details->toArray())}} --}}
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.instructor.fields.id') }}
                            </th>
                            <td>
                                {{ $reservation->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.user_name') }}
                            </th>
                            <td>
                                {{ app()->getLocale() == 'en' ? $reservation->payment_details->first()->user_name_en ?? '' : $reservation->payment_details->first()->user_name_ar ?? '' }}

                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.course_name') }}
                            </th>
                            <td>
                                {{ json_encode($reservation->payment_details->pluck('course_name_' . app()->getLocale()), JSON_UNESCAPED_UNICODE) }}

                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.payment_number') }}
                            </th>
                            <td>
                                {{ $reservation->payment_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.transaction') }}
                            </th>
                            <td>
                                {{ $reservation->transaction }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.amount') }}
                            </th>
                            <td>
                                {{ $reservation->amount }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.reservation.fields.status') }}
                            </th>
                            <td>
                                {{ $reservation->status }}
                            </td>
                        </tr>

                    </tbody>
                </table>


                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reservations.index') }}">
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

            {{-- Order Payment --}}
            <li class="nav-item">
                <a class="nav-link active" href="#order_payment" role="tab" data-toggle="tab">
                    {{ trans('cruds.reservation.fields.payment_details') }}
                </a>
            </li>
            {{-- Course Payment --}}
            <li class="nav-item">
                <a class="nav-link" href="#course_payment" role="tab" data-toggle="tab">
                    {{ trans('cruds.reservation.fields.course_payments') }}
                </a>
            </li>
            {{-- Users --}}
            <li class="nav-item">
                <a class="nav-link" href="#users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
            {{-- Courses --}}
            <li class="nav-item">
                <a class="nav-link" href="#courses" role="tab" data-toggle="tab">
                    {{ trans('cruds.course.title') }}
                </a>
            </li>

        </ul>
        <div class="tab-content">
            {{-- Order Payment --}}
            <div class="tab-pane active" role="tabpanel" id="order_payment">
                @includeIf('admin.reservations.relationships.payment_details', [
                    'reservation_payments' => $reservation->payment_details_canceled,
                ])
            </div>

            {{-- Course Payment --}}
            <div class="tab-pane" role="tabpanel" id="course_payment">
                @includeIf('admin.reservations.relationships.course_details', [
                    'course_payments' => $reservation->payment_enrolls,
                ])
            </div>
            {{-- Users --}}
            @if (isset($reservation->user))
                <div class="tab-pane" role="tabpanel" id="users">
                    @includeIf('admin.reservations.relationships.User_Data', ['users' => $reservation->user])
                </div>
            @endif
            {{--  Courses --}}
            <div class="tab-pane" role="tabpanel" id="courses">
                @includeIf('admin.reservations.relationships.course_data', [
                    'courses' => $reservation->payment_details,
                ])
            </div>

        </div>
    </div>
@endsection
