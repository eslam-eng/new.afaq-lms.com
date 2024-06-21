@extends('layouts.admin')
@section('content')
    @if (Route::is('admin.course-invoices.index'))
        @can('course_invoice_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.course-invoices.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.courseInvoice.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
    @endif
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('cruds.courseInvoice.title_singular') }}
        </div>
        <div class="pr-2 pl-2 pt-2">
            <form method="get" id="filter" action="{{ url()->full() }}">
                <div class="row">
                    <div class="form-group col-md-2 form-select">
                        <strong>{{ trans('cruds.courseInvoice.fields.status') }} </strong>
                        <select id="status" name="status" class="filter form-control custom-select-option sources">
                            <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>

                            <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') {
                                echo 'selected';
                            } ?>>
                                {{ trans('cruds.courseInvoice.fields.status_wait_payment') }}</option>
                            <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') {
                                echo 'selected';
                            } ?>>
                                {{ trans('cruds.courseInvoice.fields.status_wait_admin') }}</option>
                            <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') {
                                echo 'selected';
                            } ?>>
                                {{ trans('cruds.courseInvoice.fields.status_approved') }}</option>

                        </select>
                    </div>
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
                        <label for="course">{{ trans('cruds.reservation.fields.course') }}</label>
                        <fieldset class="form-group">
                            <select class="form-control selectpicker" id="course" name="course">
                                <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>
                                @foreach ($courses as $course)
                                    <option {{ $course->id == request('course') ? 'selected' : '' }}
                                        value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-2">
                        <label for="date_from">{{ trans('cruds.reservation.fields.date_from') }}</label>
                        <input class="form-control date {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="date"
                            name="date_from" id="date_filter" value="{{ old('date_from', request('date_from')) }}">
                        @if ($errors->has('date_from'))
                            <span class="text-danger">{{ $errors->first('date_from') }}</span>
                        @endif

                    </div>
                    <div class="form-group  col-12 col-sm-6 col-lg-2">
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
            </form>




            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover  datatable-Reservation">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.instructor.fields.id') }}
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
                                    {{ trans('cruds.reservation.fields.payment_method') }}
                                </th>

                                @if (request()->routeIs('admin.reservations.wallet_transactions'))
                                    <th>
                                        {{ trans('cruds.wallet.fields.wallet_discount') }}
                                    </th>
                                @endif
                                <th>
                                    &nbsp;
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>


                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
                    success: function(data) {}
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
                        window.location.reload()
                    }
                });
            } else {

                event.preventDefault()

            }
        }
    </script>
    <script type="text/javascript">
        $(function() {

            var table = $('.datatable-Reservation').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ request()->fullUrl() }}",
                    type: 'GET',
                    data: {
                        // Parameters
                        columnsDef: [
                            //
                        ],
                    },
                },
                columns: [{
                        data: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_phone',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'payment_details',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'amount',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'provider',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'wallet_discount',
                        orderable: true,
                        searchable: true
                    },

                ],

                columnDefs: [{
                        targets: 0,
                        title: '{{ trans('cruds.instructor.fields.id') }}',
                        render: function(data, type, full, meta) {
                            return full.id;
                        },
                    },

                    {
                        targets: 1,
                        title: '{{ trans('cruds.user.fields.email') }}',
                        render: function(data, type, full, meta) {
                            return full.user_email;
                        },
                    },
                    {
                        targets: 2,
                        title: '{{ trans('cruds.user.fields.phone') }}',
                        render: function(data, type, full, meta) {
                            return full.user_phone;
                        },
                    },
                    {
                        targets: 3,
                        title: '{{ trans('cruds.reservation.fields.course') }}',
                        render: function(data, type, full, meta) {
                            return full.payment_details;
                        },
                    },
                    {
                        targets: 4,
                        title: '{{ trans('cruds.reservation.fields.amount') }}',
                        render: function(data, type, full, meta) {
                            if (full.provider == 'Free' && full.wallet) {
                                return full.wallet_discount;
                            } else {
                                return full.amount;
                            }
                        },
                    },
                    {
                        targets: 5,
                        title: '{{ trans('cruds.reservation.fields.status') }}',
                        render: function(data, type, full, meta) {
                            return full.status ? "{{ __('afaq.invoice_approved') }}" : "{{ __('afaq.invoice_wait_approveal') }}";
                        },
                    },
                    {
                        targets: 6,
                        title: '{{ trans('cruds.reservation.fields.created_at') }}',
                        render: function(data, type, full, meta) {
                            return full.created_at;
                        },
                    },
                    {
                        targets: 7,
                        title: '{{ trans('lms.payment_method') }}',
                        render: function(data, type, full, meta) {
                            if (full.provider == 'Free' && full.wallet) {
                                return '{{ __('afaq.wallet') }}'
                            } else {
                                return full.provider;
                            }
                        },
                    },
                    @if (request()->routeIs('admin.reservations.wallet_transactions'))

                        {
                            targets: 7,
                            title: '{{ trans('cruds.wallet.fields.wallet_discount') }}',
                            render: function(data, type, full, meta) {
                                return full.wallet_discount;
                            },
                        },
                    @endif {
                        targets: 8,
                        title: '{{ trans('global.actions') }}',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var show_url =
                                "{{ route('admin.reservations.show', 'reservation:id') }}";
                            show_url = show_url.replace('reservation:id', full.id);
                            var invoice_url =
                                "{{ route('invoice.print', ['locale' => app()->getLocale(), 'payment_id' => 'payment_id']) }}";
                            invoice_url = invoice_url.replace('payment_id', full.id);
                            var value = '';
                            @can('reservation_show')
                                value += `  <div class="row">
                                            <a href="${show_url}" type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 11">
                                                    <path id="eye-light"
                                                        d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                        transform="translate(0 -32)" fill="#fff" />
                                                </svg>
                                            </a>`
                                if (full.provider == 'Bank') {
                                    if (full.approved == 0 && (full.status == 0 || full.status ==
                                            1)) {
                                        value += ` <form class="m-1" method="GET"
                                                        onclick="change_approve(${ full.id })"
                                                        style="display: inline-block;">
                                                        <input type="hidden" id="approved" name="approved"
                                                            value="1">
                                                        <input type="hidden" id="reservation_id" name="reservation_id"
                                                            value="${ full.id }">
                                                        <input type="submit" class="btn btn-xs btn-info verify_"
                                                            value="verify">
                                                    </form>
                                                    `
                                    }
                                    value += `
                                        <form class="m-1" method="GET"
                                                        onclick="delete_reseration(${ full.id })"
                                                        style="display: inline-block;">
                                                        <input type="hidden" id="reservation_id" name="reservation_id"
                                                            value="${ full.id }">
                                                        <button type="submit"
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
                                        `
                                }
                                value += `</div>`;


                                if (full.provider == 'Bank') {
                                    console.log(full.payment_invoices);
                                    if (full.payment_invoices && full.payment_invoices
                                        .invoice_image) {
                                            console.log('ssssss');
                                        value += `  <a class="btn btn-success"
                                                    href="${ full.payment_invoices.invoice_image.url}" download>
                                                   {{ __('cruds.reservation.fields.Download_Receipt') }}
                                                </a>`;
                                    }
                                }

                                if (full.approved == 1) {
                                    value += `<a href="${invoice_url}"
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
                                            </a>`;
                                    var cancel_url =
                                        "{{ route('admin.reservation.cancelPage', 'payment_id:id') }}";
                                    cancel_url = cancel_url.replace('payment_id:id', full.id);
                                    value += `
                                        <a href="${cancel_url}" class="btn btn-danger">{{ __('lms.cancel') }}</a>
                                    `;
                                }
                            @endcan
                            return value;
                        },
                    }
                ],
            });

        });
    </script>
@endsection
