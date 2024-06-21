@extends('layouts.admin')
@section('content')
@can('user_log_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">

    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.user_log.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserLog">
                <thead>
                    <tr>
<th></th>
                        <th>
                            {{ trans('cruds.user_log.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user_log.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user_log.fields.message') }}
                        </th>
                        <th>
                            {{ trans('cruds.user_log.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_logs as $key => $user_log)
                    <tr data-entry-id="{{ $user_log->id }}">
<td></td>
                        <td>
                            {{ $user_log->id ?? '' }}
                        </td>
                        <td>
                            {{ $user_log->user->name ?? '' }}
                        </td>
                        <td>
                            {{ $user_log->log_message ?? '' }}
                        </td>
                        <td>
                            {{ $user_log->created_at ?? '' }}
                        </td>
                        <td>
                            @can('user_log_show')
{{--                            <a class="btn btn-xs btn-primary" href="{{ route('admin.user-logs.show', $user_log->id) }}">--}}
{{--                                {{ trans('global.view') }}--}}
{{--                            </a>--}}

                                <a href="{{ route('admin.user-logs.show', $user_log->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                        <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                    </svg>
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
