@extends('layouts.admin')
@section('content')
{{--@can('user_attendance_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.user-attendances.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.userAttendance.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userAttendance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserAttendance">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.course') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.attendance_design') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.lecture') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.percentage') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.attend_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.userAttendance.fields.leave_time') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($userAttendances as $key => $userAttendance)

                        <tr data-entry-id="{{ $userAttendance->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userAttendance->id ?? '' }}
                            </td>

                            <td>
                                {{ app()->getLocale() == 'en' ? $userAttendance->user->full_name_en ?? '' : $userAttendance->user->full_name_ar ?? '' }}
                            </td>
                            <td>
                                {{ app()->getLocale() == 'en' ? $userAttendance->course->name_en ?? '' : $userAttendance->course->name_ar ?? '' }}
                            </td>
                            <td>
                                {{  $userAttendance->user->email ?? '' }}
                            </td>
                            <td>
                                {{  $userAttendance->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $userAttendance->attendance_design->name_en ?? '' }}
                            </td>
                            <td>

                                {{ $userAttendance->lecture->title_ar ?? '' }}
                            </td>
                            <td>
                                {{ $userAttendance->percentage ?? '' }}
                            </td>
                            <td>
                                {{ $userAttendance->attend_time ?? '' }}
                            </td>
                            <td>
                                {{ $userAttendance->leave_time ?? '' }}
                            </td>
                            <td>
                                @can('user_attendance_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-attendances.show', $userAttendance->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

{{--                                @can('user_attendance_edit')--}}
{{--                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-attendances.edit', $userAttendance->id) }}">--}}
{{--                                        {{ trans('global.edit') }}--}}
{{--                                    </a>--}}
{{--                                @endcan--}}

{{--                                @can('user_attendance_delete')--}}
{{--                                    <form action="{{ route('admin.user-attendances.destroy', $userAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--                                        <input type="hidden" name="_method" value="DELETE">--}}
{{--                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">--}}
{{--                                    </form>--}}
{{--                                @endcan--}}

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
{{--<script>--}}
{{--    $(function () {--}}
{{--  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)--}}
{{--@can('user_attendance_delete')--}}
{{--  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'--}}
{{--  let deleteButton = {--}}
{{--    text: deleteButtonTrans,--}}
{{--    url: "{{ route('admin.user-attendances.massDestroy') }}",--}}
{{--    className: 'btn-danger',--}}
{{--    action: function (e, dt, node, config) {--}}
{{--      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {--}}
{{--          return $(entry).data('entry-id')--}}
{{--      });--}}

{{--      if (ids.length === 0) {--}}
{{--        alert('{{ trans('global.datatables.zero_selected') }}')--}}

{{--        return--}}
{{--      }--}}

{{--      if (confirm('{{ trans('global.areYouSure') }}')) {--}}
{{--        $.ajax({--}}
{{--          headers: {'x-csrf-token': _token},--}}
{{--          method: 'POST',--}}
{{--          url: config.url,--}}
{{--          data: { ids: ids, _method: 'DELETE' }})--}}
{{--          .done(function () { location.reload() })--}}
{{--      }--}}
{{--    }--}}
{{--  }--}}
{{--  dtButtons.push(deleteButton)--}}
{{--@endcan--}}

{{--  $.extend(true, $.fn.dataTable.defaults, {--}}
{{--    orderCellsTop: true,--}}
{{--    order: [[ 1, 'desc' ]],--}}
{{--    pageLength: 100,--}}
{{--  });--}}
{{--  let table = $('.datatable-UserAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })--}}
{{--  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){--}}
{{--      $($.fn.dataTable.tables(true)).DataTable()--}}
{{--          .columns.adjust();--}}
{{--  });--}}

{{--})--}}

{{--</script>--}}
@endsection
