@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('cruds.reservation.title_singular') }}
        </div>

        <form method="get" id="filter" action="{{ url()->full() }}">
            <div class="row">

                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="users-list-role">{{ trans('cruds.paymentMethod.title_singular') }}</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-role" name="provider">
                            <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>
                            @foreach ($paymethod as $item)
                                <option {{ $item->provider == request('provider') ? 'selected' : '' }}
                                    value="{{ $item->provider }}">{{ $item->provider }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <button class="btn btn-xs btn-primary text-right mt-2" type="submit">
                        {{ trans('cruds.courseInvoice.fields.filter') }}
                    </button>

                </div>

                <div class="d-flex align-items-center border">
                    <div class="form-group ">
                        <label for="date_from">{{ trans('cruds.reservation.fields.date_from') }}</label>
                        <input class="form-control date {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="date"
                            name="date_from" id="date_filter" value="{{ old('date_from', request('date_from')) }}">
                        @if ($errors->has('date_from'))
                            <span class="text-danger">{{ $errors->first('date_from') }}</span>
                        @endif

                    </div>
                    <div class="form-group  ">
                        <label for="date_to">{{ trans('cruds.reservation.fields.date_to') }}</label>
                        <input class="form-control date {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="date"
                            name="date_to" id="date_filter" value="{{ old('date_to', request('date_to')) }}">
                        @if ($errors->has('date_to'))
                            <span class="text-danger">{{ $errors->first('date_to') }}</span>
                        @endif

                    </div>
                    <div class="col-12 col-sm-6 col-lg-2">
                        <button class="btn btn-xs btn-primary text-right mt-2" type="submit">
                            {{ trans('cruds.courseInvoice.fields.filter') }}
                        </button>

                    </div>
                </div>




            </div>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Reservation">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.instructor.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.course_name') }}
                            </th>
                            <!-- <th>
                                                                            {{ trans('cruds.reservation.fields.payment_number') }}
                                                                        </th> -->
                            <th>
                                {{ trans('cruds.user.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.created_at') }}
                            </th>
                            <th>
                                طريقة الدفع
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $key => $reservation)
                            <tr data-entry-id="{{ $reservation->id }}">
                                <td></td>
                                <td>
                                    {{ $reservation->id ?? '' }}
                                </td>
                                <td>
                                    {{ $reservation->user_email ?? '' }}
                                </td>
                                <td>
                                    {{ json_encode($reservation->payment_details->pluck('course_name_' . app()->getLocale()), JSON_UNESCAPED_UNICODE) }}
                                </td>
                                <!-- <td>
                                                                            {{ $reservation->payment_number ?? '' }}
                                                                        </td> -->
                                <td>
                                    {{ $reservation->user_phone ?? '' }}
                                </td>
                                <td>
                                    @if($reservation->provider == 'Free' && $reservation->wallet)
                                        {{ $reservation->wallet_discount ?? '' }}
                                    @else
                                        {{ $reservation->amount ? $reservation->amount + $reservation->wallet_discount : '' }}
                                    @endif
                                </td>
                                @if ($reservation->status == 0)
                                    <td>
                                        لا
                                    </td>
                                @else
                                    <td>
                                        نعم
                                    </td>
                                @endif
                                <td>
                                    {{ $reservation->created_at->format('Y-m-d') ?? '' }}
                                </td>
                                <td>
                                    @if($reservation->provider == 'Free' && $reservation->wallet)
                                        {{ __('lms.wallet') }}
                                    @else
                                        {{ $reservation->provider ?? '' }}
                                    @endif
                                </td>
                                {{--                                {{dd($reservation)}} --}}
                                <td>
                                    @can('reservation_show')
                                        <div class="row">
                                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 11">
                                                    <path id="eye-light"
                                                        d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                        transform="translate(0 -32)" fill="#fff" />
                                                </svg>
                                            </a>
                                            @if ($reservation->provider == 'Bank')
                                                @if ($reservation->approved == 0)
                                                    <form class="m-1" method="POST"
                                                        onclick="change_approve({{ $reservation->id }})"
                                                        style="display: inline-block;">
                                                        <input type="hidden" id="approved" name="approved"
                                                            value="{{ $reservation->approved }}">
                                                        <input type="hidden" id="reservation_id" name="reservation_id"
                                                            value="{{ $reservation->id }}">
                                                        <input type="submit" class="btn btn-xs btn-info verify_"
                                                            value="verify">
                                                    </form>


                                                @endif
                                            @endif
                                            <form class="m-1" method="GET"
                                                  onclick="delete_reseration({{ $reservation->id }})"
                                                  style="display: inline-block;">
                                                <input type="hidden" id="reservation_id" name="reservation_id"
                                                       value="{{ $reservation->id }}">
                                                {{--                                                <input type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light" value="Delete"> --}}
                                                <button type="button"
                                                        class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                         height="14" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round" class="feather feather-trash me-50">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        @if ($reservation->provider == 'Bank')
                                            @if (isset($reservation->payment_invoices->invoice_image))
                                                {{--                                        <a href="{{ $reservation->payment_invoices->invoice_image->getUrl() }}" target="_blank" style="display: inline-block"> --}}
                                                {{--                                            <img src="{{ $reservation->payment_invoices->invoice_image->getUrl('thumb') }}"> --}}
                                                {{--                                        </a> --}}
                                                <a class="btn btn-success"
                                                    href="{{ $reservation->payment_invoices->invoice_image->url }}" download>
                                                    {{ trans('cruds.reservation.fields.Download_Receipt') }}
                                                </a>
                                            @endif
                                        @endif

                                        @if ($reservation->approved == 1 && $reservation->status == 1)
                                            <a href="{{ url('/' . app()->getLocale() . '/invoice/' . $reservation->id) }}"
                                                target="_blank" type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="30"
                                                    viewBox="0 0 512 512" width="30" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m391 0h-225c-24.853 0-45 20.147-45 45v422c0 24.853 20.147 45 45 45h300c24.853 0 45-20.147 45-45v-347z"
                                                        fill="#e4f2f9" />
                                                    <path d="m391 0h-75v512h150c24.853 0 45-20.147 45-45v-347z"
                                                        fill="#bde0f1" />
                                                    <path d="m391 0v105c0 8.284 6.716 15 15 15h105z" fill="#77bee2" />
                                                    <g fill="#5f5f82">
                                                        <path
                                                            d="m426 302h-220c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z" />
                                                        <path
                                                            d="m426 212h-220c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z" />
                                                        <path
                                                            d="m426 392h-220c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z" />
                                                    </g>
                                                    <path
                                                        d="m441 287c0-8.284-6.716-15-15-15h-110v30h110c8.284 0 15-6.716 15-15z"
                                                        fill="#3c3c55" />
                                                    <path
                                                        d="m441 197c0-8.284-6.716-15-15-15h-110v30h110c8.284 0 15-6.716 15-15z"
                                                        fill="#3c3c55" />
                                                    <path d="m426 392c8.284 0 15-6.716 15-15s-6.716-15-15-15h-110v30z"
                                                        fill="#3c3c55" />
                                                    <path
                                                        d="m136 512c-74.439 0-135-60.561-135-135s60.561-135 135-135 135 60.561 135 135-60.561 135-135 135z"
                                                        fill="#fad723" />
                                                    <path d="m136 242v270c74.439 0 135-60.561 135-135s-60.561-135-135-135z"
                                                        fill="#f5b400" />
                                                    <path
                                                        d="m136 272c-57.897 0-105 47.103-105 105s47.103 105 105 105 105-47.103 105-105-47.103-105-105-105z"
                                                        fill="#f5f57f" />
                                                    <path d="m136 272v210c57.897 0 105-47.103 105-105s-47.103-105-105-105z"
                                                        fill="#fad723" />

                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.reservation.cancelPage',['payment_id' => $reservation->id ]) }}" class="btn btn-danger">{{ __('lms.cancel') }}</a>

                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function change_approve(id) {
            // alert('true')
            if (confirm('{{ trans('global.areYouSure') }}') == true) {

                var approved = 1;
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/ChangeStatusReservation',
                    data: {
                        'approved': approved,
                        'reservation_id': id
                    },
                    success: function(data) {
                        window.location.reload()
                    }
                });
            } else {
                event.preventDefault()

            }
        }

        function delete_reseration(id) {

            if (confirm('{{ trans('global.areYouSure') }}') == true) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/DeleteReservationInvoices',
                    data: {
                        'reservation_id': id
                    },
                    success: function(data) {
                        if (data) {
                            location.reload()
                        }
                    }
                });
            } else {

                event.preventDefault()

            }
        }
    </script>
@endsection
