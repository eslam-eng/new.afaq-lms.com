@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.businessPayment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="pr-2 pl-2 pt-2">
        <form method="get" id="filter" action="{{ route('admin.business-payments.index') }}">
            <div class="row">
{{--                action="{{ url()->full() }}"--}}
                <div class="form-group col-md-2 form-select">
                    <strong>{{ trans('cruds.courseInvoice.fields.status') }} </strong>
                    <select id="status" name="status" class="filter form-control custom-select-option sources">
                        <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>


                        <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') {
                            echo 'selected';
                        } ?>>
                            {{__('afaq.success_pay')}}</option>
                        <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') {
                            echo 'selected';
                        } ?>>
                            {{__('afaq.failed_pay')}}</option>
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
                    <label for="users-list-status">{{ trans('cruds.businessPackage.title_singular') }}</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-status" name="package_id">
                            <option value="">All</option>
                            @foreach ($businessPackages as $item)
                                <option {{ $item->id == request('package_id') ? 'selected' : '' }}
                                        value="{{ $item->id }}">
                                    {{ app()->getLocale() == 'en' ? $item->package_name_en : $item->package_name_ar }}</option>
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
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BusinessPayment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.businessPayment.fields.id') }}
                        </th>

                        <th>
                            {{ trans('cruds.businessPayment.fields.user') }}
                        </th>
                        <th>
                            {{  trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{  trans('cruds.user.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessPayment.fields.price') }}
                        </th>


                        <th>
                            {{ trans('cruds.businessPayment.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('lms.payment_method') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>

                        {{-- <th>
                            {{ trans('cruds.businessPayment.fields.payment_method') }}
                        </th> --}}

                        {{-- <th>
                            {{ trans('cruds.businessPayment.fields.price_package_month') }}
                        </th> --}}
                        {{-- <th>
                            {{ trans('cruds.businessPayment.fields.package_month_price_offers') }}
                        </th> --}}


{{--                        <th>--}}
{{--                            {{ trans('cruds.businessPayment.fields.initial_response') }}--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.businessPayment.fields.status_response') }}--}}
{{--                        </th>--}}

                        {{-- <th>
                            {{ trans('cruds.businessPayment.fields.package_price_type') }}
                        </th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach($businessPayments as $key => $businessPayment)
                        <tr data-entry-id="{{ $businessPayment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $businessPayment->id ?? '' }}
                            </td>

                            <td>
                               {{ $businessPayment->user ? (app()->getLocale() == 'en' ? $businessPayment->user->full_name_en :$businessPayment->user->full_name_ar) : '' }}
                            </td>
                            <td>
                                {{  $businessPayment->user->email ?? '' }}
                            </td>
                            <td>
                                {{  $businessPayment->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $businessPayment->package ? (app()->getLocale() == 'en' ? $businessPayment->package->package_name_en :$businessPayment->package->package_name_ar) : '' }}
                            </td>
                            <td>
                                {{  $businessPayment->package ? $businessPayment->package->event_number : '' }}
                            </td>
                            <td>
                                {{ $businessPayment->price ?? '' }}
                            </td>



{{--                            <td>--}}
{{--                                {{ App\Models\BusinessPayment::STATUS_RADIO[$businessPayment->status] ?? '' }}--}}
{{--                            </td>--}}
                            @if($businessPayment->status == "1")
                                <td>
                                    {{__('afaq.success_pay')}}
                                </td>
                            @else
                                <td>
                                    {{__('afaq.failed_pay')}}
                                </td>
                            @endif
                            <td>
                                {{ $businessPayment->created_at ?? '' }}
                            </td>
                            <td>
                                {{$businessPayment->provider}}
                            </td>
                            <td>
                                @can('business_payment_show')

                                    <a href="{{ route('admin.business-payments.show', $businessPayment->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                            <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                        </svg>
                                    </a>
                                @endcan


                                @can('business_payment_delete')

                                        <form action="{{ route('admin.business-payments.destroy', $businessPayment->id) }}" method="POST"
                                              onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                @endcan


                                    @if($businessPayment->status == 1)

                                        <a href="{{ route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $businessPayment->id]) }}">

                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50"
                                                 height="50" viewBox="0 0 96.41 122.88"
                                                 style="enable-background:new 0 0 96.41 122.88" xml:space="preserve"><g>
                                                    <path
                                                        d="M65.07,122.88H5.45c-1.47,0-2.85-0.61-3.85-1.61S0,118.94,0,117.42V5.45C0,3.94,0.61,2.6,1.6,1.6S3.94,0,5.45,0 c27.78,0,57.77,0,85.41,0c1.52,0,2.85,0.61,3.85,1.6c1,0.99,1.61,2.33,1.61,3.85v85.67c0.04,0.21,0.09,0.39,0.09,0.61 c0,0.74-0.34,1.39-0.83,1.86l-28.18,28.5C66.93,122.56,65.83,122.9,65.07,122.88L65.07,122.88z M12.78,13.73h3.33v13.94h-3.33 V13.73L12.78,13.73z M18.92,13.73h3.1l4.03,7.7v-7.7h3.14v13.94h-3.14l-4.01-7.66v7.66h-3.12V13.73L18.92,13.73z M30.74,13.73h3.47 l2.42,10.04l2.39-10.04h3.37L38.4,27.67h-3.6L30.74,13.73L30.74,13.73z M42.93,20.71c0-2.28,0.49-4.05,1.47-5.31 c0.98-1.27,2.34-1.9,4.09-1.9c1.79,0,3.17,0.62,4.14,1.87c0.97,1.24,1.45,2.99,1.45,5.23c0,1.63-0.21,2.96-0.63,4 c-0.42,1.04-1.04,1.85-1.83,2.43c-0.8,0.58-1.8,0.87-2.99,0.87c-1.21,0-2.22-0.25-3.01-0.75c-0.79-0.5-1.44-1.3-1.93-2.38 C43.18,23.7,42.93,22.34,42.93,20.71L42.93,20.71z M46.25,20.72c0,1.41,0.2,2.42,0.61,3.03c0.4,0.61,0.96,0.92,1.65,0.92 c0.71,0,1.27-0.3,1.66-0.9c0.39-0.6,0.59-1.68,0.59-3.24c0-1.31-0.21-2.27-0.61-2.87c-0.41-0.61-0.96-0.91-1.66-0.91 c-0.67,0-1.21,0.31-1.62,0.92C46.46,18.28,46.25,19.3,46.25,20.72L46.25,20.72z M56.39,13.73h3.33v13.94h-3.33V13.73L56.39,13.73z M69.66,21.97l2.91,1.14c-0.2,1.06-0.51,1.94-0.93,2.65c-0.42,0.71-0.94,1.25-1.57,1.61c-0.62,0.36-1.42,0.54-2.38,0.54 c-1.17,0-2.13-0.22-2.87-0.66c-0.74-0.44-1.38-1.22-1.92-2.32c-0.54-1.1-0.81-2.53-0.81-4.25c0-2.3,0.47-4.08,1.42-5.32 c0.95-1.24,2.29-1.86,4.02-1.86c1.35,0,2.42,0.35,3.2,1.06c0.77,0.71,1.35,1.8,1.73,3.27l-2.93,0.84c-0.1-0.42-0.21-0.73-0.32-0.92 c-0.19-0.33-0.42-0.58-0.68-0.76c-0.27-0.18-0.57-0.27-0.9-0.27c-0.76,0-1.33,0.39-1.73,1.17c-0.3,0.58-0.46,1.5-0.46,2.74 c0,1.54,0.18,2.6,0.54,3.17c0.36,0.57,0.87,0.86,1.53,0.86c0.64,0,1.12-0.23,1.44-0.69C69.28,23.52,69.51,22.85,69.66,21.97 L69.66,21.97z M74.57,13.73h8.89v2.98h-5.56v2.22h5.15v2.84h-5.15v2.75h5.72v3.16h-9.05V13.73L74.57,13.73z M27.57,91.41 c2.2,0,4.19,0.89,5.64,2.34c1.44,1.44,2.34,3.44,2.34,5.64c0,2.2-0.89,4.19-2.34,5.64c-1.44,1.44-3.44,2.33-5.64,2.33 s-4.19-0.89-5.64-2.33c-1.44-1.44-2.34-3.44-2.34-5.64c0-2.2,0.89-4.2,2.34-5.64C23.38,92.3,25.37,91.41,27.57,91.41L27.57,91.41z M31.16,95.8c-0.92-0.92-2.19-1.48-3.59-1.48s-2.67,0.57-3.59,1.48s-1.48,2.19-1.48,3.59c0,1.4,0.57,2.67,1.48,3.59 s2.19,1.48,3.59,1.48s2.67-0.57,3.59-1.48s1.48-2.19,1.48-3.59C32.65,97.98,32.08,96.71,31.16,95.8L31.16,95.8z M27.57,84.81 c4.02,0,7.66,1.63,10.3,4.27c2.64,2.64,4.27,6.28,4.27,10.3c0,4.02-1.63,7.66-4.27,10.29c-2.64,2.64-6.28,4.27-10.3,4.27 s-7.67-1.63-10.3-4.27c-2.64-2.64-4.27-6.28-4.27-10.3c0-4.02,1.63-7.67,4.27-10.3L17.36,89C19.99,86.41,23.6,84.81,27.57,84.81 L27.57,84.81z M35.83,91.13c-2.11-2.11-5.03-3.41-8.25-3.41c-3.19,0-6.08,1.28-8.19,3.35l-0.07,0.07 c-2.11,2.11-3.42,5.03-3.42,8.25c0,3.22,1.31,6.14,3.42,8.25c2.11,2.11,5.03,3.42,8.25,3.42s6.14-1.31,8.25-3.42 c2.11-2.11,3.42-5.03,3.42-8.25C39.24,96.16,37.94,93.24,35.83,91.13L35.83,91.13z M23.52,44.71c-0.97,0-1.75-0.78-1.75-1.75 s0.78-1.75,1.75-1.75h35.12c0.97,0,1.75,0.78,1.75,1.75s-0.78,1.75-1.75,1.75H23.52L23.52,44.71z M23.52,70.84 c-0.97,0-1.75-0.78-1.75-1.75c0-0.97,0.78-1.75,1.75-1.75h48.42c0.97,0,1.75,0.78,1.75,1.75c0,0.97-0.78,1.75-1.75,1.75H23.52 L23.52,70.84z M23.52,60.14c-0.97,0-1.75-0.78-1.75-1.75c0-0.97,0.78-1.75,1.75-1.75h35.12c0.97,0,1.75,0.78,1.75,1.75 c0,0.97-0.78,1.75-1.75,1.75H23.52L23.52,60.14z M79.32,51.71H17.09v23.93h62.23V51.71L79.32,51.71z M17.09,48.21h62.23V37.58 H17.09V48.21L17.09,48.21z M15.34,34.08h65.73c0.97,0,1.75,0.78,1.75,1.75v14.13V77.4c0,0.97-0.78,1.75-1.75,1.75H15.34 c-0.97,0-1.75-0.79-1.75-1.75V49.96V35.83C13.59,34.87,14.37,34.08,15.34,34.08L15.34,34.08z M63,117.98V96.65 c0-2.04,0.83-3.9,2.17-5.24c1.34-1.34,3.2-2.17,5.24-2.17h20.94V5.44c0-0.13-0.04-0.3-0.18-0.39c-0.09-0.09-0.22-0.18-0.39-0.18 c-21.99,0-63.97,0-85.36,0c-0.13,0-0.31,0.04-0.39,0.18C4.92,5.14,4.83,5.31,4.83,5.44v111.98c0,0.18,0.04,0.3,0.18,0.39 c0.09,0.09,0.22,0.18,0.39,0.18h57.54L63,117.98L63,117.98L63,117.98z M67.89,96.65v17.87l20.12-20.38H70.4 c-0.69,0-1.3,0.31-1.77,0.74C68.19,95.31,67.89,95.96,67.89,96.65L67.89,96.65L67.89,96.65z"/>
                                                </g></svg>
                                        </a>

                                    @endif
                            </td>

                            {{-- <td>
                                {{ $businessPayment->payment_method_id ?? '' }}
                            </td> --}}
                            {{-- <td>

                                {{app()->getLocale()=='en' ?  $businessPayment->package_name_en ?? '' :  $businessPayment->package_name_ar ?? ''}}

                            </td> --}}
                            {{-- <td>
                                {{ $businessPayment->price_package_month ?? '' }}
                            </td> --}}
                            {{-- <td>
                                {{ $businessPayment->package_month_price_offers ?? '' }}
                            </td> --}}
{{--                            <td>--}}
{{--                                {{ $businessPayment->initial_response ?? '' }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $businessPayment->status_response ?? '' }}--}}
{{--                            </td>--}}


                            {{-- <td>
                                {{ $businessPayment->package_price_type ?? '' }}
                            </td> --}}



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



    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('business_payment_delete')

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.business-payments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  // $.extend(true, $.fn.dataTable.defaults, {
  //   orderCellsTop: true,
  //   order: [[ 1, 'desc' ]],
  //   pageLength: 100,
  // });
//   let table = $('.datatable-BusinessPayment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
//   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
//       $($.fn.dataTable.tables(true)).DataTable()
//           .columns.adjust();
//   });
//
// })

</script>
@endsection
