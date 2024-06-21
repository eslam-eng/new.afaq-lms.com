@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pointAction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PointAction">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.from_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.points') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointAction.fields.type') }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pointActions as $key => $pointAction)
                        <tr data-entry-id="{{ $pointAction->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pointAction->id ?? '' }}
                            </td>
                            <td>
                                {{ $pointAction->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $pointAction->from_user->name ?? '' }}
                            </td>
                            <td>
                                {{ $pointAction->amount ?? '' }}
                            </td>
                            <td>
                                {{ $pointAction->points ?? '' }}
                            </td>
                            <td>
                                {{ $pointAction->type ?? '' }}
                            </td>

                            <td>
                                @can('point_action_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.point-actions.show', $pointAction->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('point_action_delete')
                                    <form action="{{ route('admin.point-actions.destroy', $pointAction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
@can('point_action_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.point-actions.massDestroy') }}",
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
  // let table = $('.datatable-PointAction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
  //     $($.fn.dataTable.tables(true)).DataTable()
  //         .columns.adjust();
  // });

})

</script>
@endsection
