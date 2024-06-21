@extends('layouts.admin')
@section('content')
{{--@can('ticket_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.tickets.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.ticket.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ticket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Ticket">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.title') }}
                        </th>

                        <th>
                            {{ trans('cruds.ticket.fields.replies_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.statues') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $key => $ticket)
                        <tr data-entry-id="{{ $ticket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ticket->id ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->user->email ?? '' }}
                            </td>
                            <td>
                                {{app()->getLocale()=='en' ?  $ticket->ticket_category->title_en ?? '' :  $ticket->ticket_category->title_ar ?? ''}}

                            </td>
                            <td>
                                {{ $ticket->title ?? '' }}


                            </td>

                            <td>
                                {{ $ticket->replies_number ?? '' }}
                            </td>
                            @if($ticket->statues == "1")
                                <td>
                                    {{ trans('cruds.ticket.fields.Resolved')  }}
                                </td>
                            @else
                                <td>
                                    {{ trans('cruds.ticket.fields.Opened')  }}
                                </td>
                            @endif
                            <td>
                                {{ $ticket->description ?? '' }}
                            </td>
                            <td>
                                @if($ticket->image)
                                    <a href="{{ url('storage/'.$ticket->image) }}" target="_blank"  style="display: inline-block">
                                        <img src="{{ url('storage/'.$ticket->image) }}" alt="" height="150" width="150">
                                    </a>
{{--                                    <img src="{{ url('storage/'.$ticket->image) }}" alt="" title="" />--}}

                                @endif
                            </td>
                            <td>
                                {{$ticket->created_at->diffForHumans()}}
{{--                                {{ $ticket->created_at ? date('Y-m-d h:i A' , strtotime($ticket->created_at)) : '' }}--}}

                            </td>
                            <td>
                                {{ App\Models\Ticket::TYPE_SELECT[$ticket->type] ?? '' }}
                            </td>
                            <td>
                                @can('ticket_show')
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}"
                                       type="button"
                                       class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             viewBox="0 0 14 11">
                                            <path id="eye-light"
                                                  d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                  transform="translate(0 -32)" fill="#fff" />
                                        </svg>
                                    </a>
                                @endcan

{{--                                @can('ticket_edit')--}}
{{--                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}"--}}
{{--                                           type="button"--}}
{{--                                           class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"--}}
{{--                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                                                 stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                 class="feather feather-eye-2 me-50">--}}
{{--                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                @endcan--}}

{{--                                @can('ticket_delete')--}}
{{--                                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--                                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                            <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">--}}
{{--                                                    <polyline points="3 6 5 6 21 6"></polyline>--}}
{{--                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                @endcan--}}
                                    @if ($ticket->statues == 0 )
                                        <form  action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST"
                                               onclick="return confirm('{{ trans('global.areYouSure') }}');"
                                               style="display: inline-block;">
                                            <input type="hidden" name="_method" value="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                                            <input type="submit" class="btn btn-xs btn-info verify_1" value="Close">
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
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tickets.massDestroy') }}",
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

    })


</script>
@endsection
