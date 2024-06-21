@extends('layouts.admin')
@section('content')
    @if(Route::is('admin.course-invoices.index') )
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
                        @if(Route::is('admin.course-invoices.index') )
                        <div class="form-group col-md-2 form-select">
                            <strong>{{ trans('cruds.courseInvoice.fields.status') }} </strong>
                            <select id="status" name="status" class="filter form-control custom-select-option sources">
                                <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>

                                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') {
                                    echo "selected";
                                } ?>>{{ trans('cruds.courseInvoice.fields.status_wait_payment') }}</option>
                                <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') {
                                    echo "selected";
                                } ?>>{{ trans('cruds.courseInvoice.fields.status_wait_admin') }}</option>
                                <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') {
                                    echo "selected";
                                } ?>>{{ trans('cruds.courseInvoice.fields.status_approved') }}</option>

                            </select>
                        </div>
                        @endif
                        <div class="col-12 col-sm-6 col-lg-2">
                            <label for="users-list-role">{{ trans('cruds.bankList.title_singular') }}</label>
                            <fieldset class="form-group">
                                <select class="form-control" id="users-list-role" name="bank_id">
                                    <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>
                                    @foreach($banks as $item)
                                        <option {{$item->id == request('bank_id') ? 'selected' : ''}} value="{{$item->id}}">{{app()->getLocale() == 'en' ? $item->name_en : $item->name_ar}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div style="width: 10px"></div>
                        <div class="form-group  ">
                            <label  for="date_to">{{ trans('cruds.courseInvoice.fields.date') }}</label>
                            <input class="form-control date {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="date" name="date_to" id="date_filter" value="{{ old('date_to', request('date_to')) }}" >
                            @if($errors->has('date_to'))
                                <span class="text-danger">{{ $errors->first('date_to') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courseInvoice.fields.date_helper') }}</span>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-2">
                            <button class="btn btn-xs btn-primary text-right mt-2" type="submit">
                                {{ trans('cruds.courseInvoice.fields.filter') }}
                            </button>

                        </div>


                    </div>
                </form>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-CourseInvoice">
                    <thead>
                    <tr>
                        <th></th>

                        <th>
                            {{ trans('cruds.courseInvoice.fields.invoice') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.amount') }}.{{ trans('cruds.courseInvoice.fields.currency') }}

                        </th>


                        <th>

                            {{ trans('cruds.blogscomment.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseInvoice.fields.invoice_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($courseInvoices as $key => $courseInvoice)
                        <tr data-entry-id="{{ $courseInvoice->id }}">
                            <td></td>

                            <td>
                                {{ $courseInvoice->payment ? $courseInvoice->payment->id : $courseInvoice->invoice_id }}
                            </td>
                            <td>

                                {{ json_encode($courseInvoice->courses->pluck('course_name_'.app()->getLocale()), JSON_UNESCAPED_UNICODE)}}

                            </td>
                            <td>
                                {{ $courseInvoice->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $courseInvoice->amount ?? '' }}/{{ $courseInvoice->currency ?? '' }}
                            </td>


                            <td>
                                {{ $courseInvoice->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $courseInvoice->date ?? '' }}
                            </td>
                            <td>
                                @if($courseInvoice->invoice_image)
                                    <a href="{{ $courseInvoice->invoice_image->getUrl() }}" target="_blank" >
                                        <img src="{{ $courseInvoice->invoice_image->getUrl('thumb')  }}" style="display: inline-block;width:100px;height: 100px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('course_invoice_show')

                                    <a href="{{ route('admin.course-invoices.show', $courseInvoice->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                            <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('course_invoice_edit')

                                    {{-- <a href="{{ route('admin.course-invoices.edit', $courseInvoice->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a> --}}
                                @endcan

                                @can('course_invoice_delete')

                                    {{-- <form action="{{ route('admin.course-invoices.destroy', $courseInvoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form> --}}
                                @endcan
                            <td>
{{--                                <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">--}}
{{--                                    <input type="checkbox" class="custom-control-input" id="approved{{$payment->id }}" data-id="{{$payment->id}}" onchange="change_approve({{$payment->id}})" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="Un Approve" data-on="Approve" {{$payment->approved == true ? 'checked' : '' }}>--}}
{{--                                    <label class="custom-control-label" for="approved{{$payment->id}}">--}}
{{--                                        <span class="switch-text-right">لم يتم الدفع</span>--}}
{{--                                        <span class="switch-text-left">تم الدفع</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                                @if($courseInvoice->payment && !$courseInvoice->payment->approved)
                                <form class="m-1"  method="POST" onclick="change_approve({{ $courseInvoice->payment->id }})" style="display: inline-block;">
                                    <input type="hidden" id="approved" name="approved" value="{{  $courseInvoice->payment->approved }}">
                                    <input type="hidden" id="reservation_id" name="reservation_id" value="{{ $courseInvoice->payment->id }}">
                                    <input type="submit" class="btn btn-xs btn-info verify_" value="verify">
                                </form>
                                @endif
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
    <script>

        function clearForm() {
            document.getElementById("filter").reset();
        }
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
    </script>


@endsection
