@extends('layouts.admin')
@section('content')
    @can('user_notification_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-notifications.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userNotification.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userNotification.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-UserNotification">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.message') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.userNotification.fields.created_at') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.userNotification.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.userNotification.fields.read') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.userNotification.fields.fcm_token') }}--}}
{{--                        </th>--}}
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userNotifications as $key => $userNotification)
                        <tr data-entry-id="{{ $userNotification->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userNotification->id ?? '' }}
                            </td>
                            <td>
                                {{ $userNotification->parent_id ?? '' }}
                            </td>
                            <td>
                                {{ $userNotification->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $userNotification->type ?? '' }}
                            </td>
                            <td>
                                {{app()->getLocale()=='en' ? $userNotification->title_en ?? '' : $userNotification->title_ar ?? ''}}
                            </td>
                            <td>
                                {{app()->getLocale()=='en' ? $userNotification->message_en ?? '' : $userNotification->message_ar ?? ''}}
                            </td>

                            <td>
                                {{ App\Models\UserNotification::STATUS_RADIO[$userNotification->status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UserNotification::READ_RADIO[$userNotification->read] ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                {{ $userNotification->fcm_token ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                @can('user_notification_show')
                                    <a href="{{ route('admin.user-notifications.show', $userNotification->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                            <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                        </svg>
                                    </a>


                                @endcan

{{--                                @can('user_notification_edit')--}}
{{--                                    <a href="{{ route('admin.user-notifications.edit', $userNotification->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light courses_admin_buttons ">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">--}}
{{--                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                @endcan--}}
                                @can('user_notification_delete')
                                    <form action="{{ route('admin.user-notifications.destroy', $userNotification->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('user_notification_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.user-notifications.massDestroy') }}",
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            // let table = $('.datatable-UserNotification:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });

        })

    </script>
@endsection
