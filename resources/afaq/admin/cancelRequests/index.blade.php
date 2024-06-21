@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.cancelRequest.title_singular') }} {{ trans('global.list') }}
        </div>
{{--        <div class="form-group col-6">--}}
{{--            <label for="">{{ __('afaq.refound_method') }}</label>--}}
{{--            <select name="refound_type" class="form-control" id="">--}}
{{--                <option value="bank_account">{{ __('afaq.to_bank_account') }}</option>--}}
{{--                <option value="wallet">{{ __('afaq.wallet') }}</option>--}}
{{--            </select>--}}
{{--        </div>--}}
        <form method="get" id="filter" action="{{ url()->full() }}">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="">{{ __('afaq.refound_method') }}</label>
                    <select name="refound_type" class="form-control" id="">
                        <option value="">{{ trans('global.pleaseSelect') }}</option>

                        <option value="bank_account" <?php if (isset($_GET['refound_type']) && $_GET['refound_type'] == 'bank_account') {
                            echo 'selected';
                        } ?>>
                            {{ trans('afaq.to_bank_account') }}</option>

                        <option value="wallet" <?php if (isset($_GET['refound_type']) && $_GET['refound_type'] == 'wallet') {
                            echo 'selected';
                        } ?>>
                            {{ trans('afaq.wallet') }}</option>
                    </select>
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
                <table class=" table table-bordered table-striped table-hover datatable datatable-CancelRequest">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.course') }}
                            </th>

                            <th>
                                {{ trans('cruds.cancelRequest.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.amount') }}
                            </th>
{{--                            <th>--}}
{{--                                {{ trans('cruds.cancelRequest.fields.status') }}--}}
{{--                            </th>--}}
                            <th>
                                {{ trans('cruds.cancelRequest.fields.approved') }}
                            </th>
{{--                            @if($cancelRequest->rejected)--}}
                            <th>
                               {{ trans('cruds.cancelRequest.fields.Rejection') }}

                            </th>
{{--                            @endif--}}
                            <th>
                                {{ trans('cruds.cancelRequest.fields.cancel_reason') }}
                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.cancelRequest.fields.Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
{{--                    {{dd($cancelRequests->toArray())}}--}}
                        @foreach ($cancelRequests as $key => $cancelRequest)
                            <tr data-entry-id="{{ $cancelRequest->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $cancelRequest->id ?? '' }}
                                </td>

                                <td>
                                    {{ app()->getLocale() == 'en' ? $cancelRequest->course->name_en ?? '' : $cancelRequest->course->name_ar ?? '' }}
                                </td>
                                <td>
                                    {{ app()->getLocale() == 'en' ? $cancelRequest->user->full_name_en ?? '' : $cancelRequest->user->full_name_ar ?? '' }}

                                </td>

                                <td>
                                    @if($cancelRequest->type && $cancelRequest->type =='wallet')
                                        {{ trans('afaq.wallet') }}
                                    @elseif( $cancelRequest->type && $cancelRequest->type == 'bank_account')
                                        {{ trans('afaq.to_bank_account') }}
                                    @endif
                                </td>

                                <td>
                                    {{ $cancelRequest->amount ?? '' }}
                                </td>
{{--                                <td>--}}
{{--                                    {{ App\Models\CancelRequest::STATUS_RADIO[$cancelRequest->status] ?? '' }}--}}
{{--                                </td>--}}

                                <td>
{{--                                    {{ App\Models\CancelRequest::APPROVED_SELECT[$cancelRequest->approved] ?? '' }}--}}
                                    @if( $cancelRequest->approved == 1)
                                        {{ trans('cruds.cancelRequest.fields.Approved') }}
                                    @elseif( $cancelRequest->approved == 0)
                                        {{ trans('cruds.cancelRequest.fields.Unapproved') }}
                                    @endif
                                </td>


                                    <td>
{{--                                        {{ App\Models\CancelRequest::Rejected_SELECT[$cancelRequest->rejected] ?? '' }}--}}
{{--                                        {{dd($cancelRequest->rejected)}}--}}

                                        @if( $cancelRequest->rejected == 1)
                                            {{ trans('cruds.cancelRequest.fields.Rejected') }}
                                        @elseif( $cancelRequest->rejected == 0)
                                            {{ trans('cruds.cancelRequest.fields.NotRejected') }}
                                        @endif
                                    </td>

                                <td>

                                    {{ $cancelRequest->cancel_reason ? substr($cancelRequest->cancel_reason, 0, 100) : '' }}
                                </td>
                                <td>

                                    {{ $cancelRequest->created_at}}
                                </td>
                                <td>
                                    @can('cancel_request_show')
                                        @if($cancelRequest->payment_id)
                                        <a href="{{ route('admin.reservations.show', ['reservation' => $cancelRequest->payment_id]) }}" type="button"
                                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 14 11">
                                                <path id="eye-light"
                                                    d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                    transform="translate(0 -32)" fill="#fff" />
                                            </svg>
                                        </a>
                                        @endif
                                    @endcan
                                    @if(!$cancelRequest->approved && !$cancelRequest->rejected)
                                    <button type="button" class="btn btn-icon btn-icon rounded-circle btn-info open-modal-button" cancel_request_id="{{ $cancelRequest->id }}" cancel_reason="{{ $cancelRequest->cancel_reason }}" course_id="{{ $cancelRequest->course_id }}" user_id="{{ $cancelRequest->user_id }}"  data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-check-square"></i>
                                    </button>

                                    @can('cancel_request_delete')
                                        <form action="{{ route('admin.cancel-requests.destroy', $cancelRequest->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit"
                                                class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash me-50">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="w-100" method="POST" action="{{ route('admin.cancel-request.verify') }}">
                <div class="col-12 d-flex">
                    <input type="hidden" class="cancel_request_id_input"  name="cancel_request_id">
                    <div class="form-group col-6">
                        <label for="">{{ __('afaq.refound_amount') }}</label>
                        <input
                            type="number"
                            min="0"
                            step="0.1"
                            name="refound_amount"
                            class="form-control refound_value"
                            value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('afaq.refound_method') }}</label>
                        <select name="refound_type" class="form-control" id="">
                            <option value="bank_account">{{ __('afaq.to_bank_account') }}</option>
                            <option value="wallet">{{ __('afaq.wallet') }}</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">{{ __('afaq.Save') }}</button>
            </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('cancel_request_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.cancel-requests.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan


        })
    </script>

    <script>
        $('.open-modal-button').on('click',function(){
            $('.cancel_request_id_input').val($(this).attr('cancel_request_id'));
        });
    </script>
@endsection
