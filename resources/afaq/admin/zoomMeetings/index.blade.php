@extends('layouts.admin')
@section('content')
@can('zoom_meeting_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.zoom-meetings.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.zoomMeeting.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.zoomMeeting.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ZoomMeeting text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.course') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.start_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.join_url') }}
                        </th>

                        <th>
                            {{ trans('cruds.zoomMeeting.fields.topic') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.start_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.password') }}
                        </th>


                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($zoomMeetings as $key => $zoomMeeting)
                    <tr data-entry-id="{{ $zoomMeeting->id }}">
                        <td></td>
                        <td>
                            {{ $zoomMeeting->id ?? '' }}
                        </td>
                        <td>
                            {{ $zoomMeeting->meeting_type ?? '' }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $zoomMeeting->course->name_en ?? '' : $zoomMeeting->course->name_ar ?? ''}}
                        </td>
                        <td>
                            <a target="_blank" href="{{ $zoomMeeting->start_url ?? '' }}">{{substr($zoomMeeting->start_url,0,50) ?? '' }}</a>

                        </td>
                        <td>
                            <a target="_blank" href="{{ $zoomMeeting->join_url ?? '' }}">{{substr($zoomMeeting->join_url,0,50) ?? '' }}</a>
                        </td>
                        <td>
                            {{ $zoomMeeting->topic ?? '' }}
                        </td>
                        <td>
                            {{ $zoomMeeting->start_time ?? '' }}
                        </td>
                        <td>
                            {{ $zoomMeeting->duration ?? '' }}
                        </td>
                        <td>
                            {{ $zoomMeeting->password ?? '' }}
                        </td>


                        <td>
                            @can('zoom_meeting_show')

                            <a href="{{ route('admin.zoom-meetings.show', $zoomMeeting->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                    <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                </svg>
                            </a>
                            @endcan

                            @can('zoom_meeting_edit')

                            <a href="{{ route('admin.zoom-meetings.edit', $zoomMeeting->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light courses_admin_buttons ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>
                            @endcan

                            @can('zoom_meeting_delete')
                            <form action="{{ route('admin.zoom-meetings.destroy', $zoomMeeting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

                            @can('zoom_meeting_show')
                                <a class="btn btn-xs btn-info courses_admin_buttons" href="{{ route('admin.zoom-meetings.report', $zoomMeeting->id) }}">
                                    <!-- {{trans('global.report')}} -->
                                    <i class="feather icon-file"></i>
                                </a> 
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