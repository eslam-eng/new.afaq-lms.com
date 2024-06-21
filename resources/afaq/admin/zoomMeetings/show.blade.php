@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.zoomMeeting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zoom-meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.id') }}
                        </th>
                        <td>
                            {{ $zoomMeeting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.course') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ? $zoomMeeting->course->name_en ?? '' : $zoomMeeting->course->name_ar ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.start_url') }}
                        </th>
                        <td>
                            <a href="{{ $zoomMeeting->start_url ?? '' }}">{{substr($zoomMeeting->start_url,0,50) ?? '' }}</a>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.join_url') }}
                        </th>
                        <td>
                            <a href="{{ $zoomMeeting->join_url ?? '' }}">{{substr($zoomMeeting->join_url,0,50) ?? '' }}</a>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.topic') }}
                        </th>
                        <td>
                            {{ $zoomMeeting->topic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.start_time') }}
                        </th>
                        <td>
                            {{ $zoomMeeting->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.duration') }}
                        </th>
                        <td>
                            {{ $zoomMeeting->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.agenda') }}
                        </th>
                        <td>
                            {!! $zoomMeeting->agenda !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.host_video') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $zoomMeeting->host_video ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.participant_video') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $zoomMeeting->participant_video ? 'checked' : '' }}>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\ZoomMeeting::TYPE_SELECT[$zoomMeeting->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.audio') }}
                        </th>
                        <td>
                            {{ App\Models\ZoomMeeting::AUDIO_SELECT[$zoomMeeting->audio] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.auto_recording') }}
                        </th>
                        <td>
                            {{ App\Models\ZoomMeeting::AUTO_RECORDING_SELECT[$zoomMeeting->auto_recording] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.alternative_hosts') }}
                        </th>
                        <td>
                            {{ $zoomMeeting->alternative_hosts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.mute_upon_entry') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $zoomMeeting->mute_upon_entry ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.watermark') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $zoomMeeting->watermark ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.waiting_room') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $zoomMeeting->waiting_room ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zoom-meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>

    @if($zoomMeeting->reports)
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
                            {{ trans('cruds.zoomMeeting.fields.user_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.user_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.join_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.leave_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.join_percentage') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.failover') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.zoomMeeting.fields.customer_key') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($zoomMeeting->reports as $key => $report)
                    <tr data-entry-id="{{ $report->id }}">
                        <td></td>
                        <td>
                            {{ $report->report_id ?? '' }}
                        </td>
                        <td>
                            {{ $report->name ?? '' }}
                        </td>
                        <td>
                            {{$report->user_email ?? ''}}
                        </td>
                        <td>
                            {{$report->join_time ? date('Y-m-d h:i A' , strtotime($report->join_time)) : '' }}
                        </td>
                        <td>
                            {{$report->leave_time ? date('Y-m-d h:i A' , strtotime($report->leave_time)) : '' }}
                        </td>
                        <td>
                            {{ $report->duration ?? '' }}
                        </td>
                        <td>
                            {{ $report->join_percentage ? $report->join_percentage . '%' : '' }}
                        </td>
                        <td>
                            {{ $report->attentiveness_score ?? '' }}
                        </td>
                        <td>
                            {{ $report->failover ?? '' }}
                        </td>
                        <td>
                            {{ $report->status ?? '' }}
                        </td>
                        <td>
                            {{ $report->customer_key ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>



@endsection