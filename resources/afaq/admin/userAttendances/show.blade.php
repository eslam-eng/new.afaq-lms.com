@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userAttendance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.id') }}
                        </th>
                        <td>
                            {{ $userAttendance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.user') }}
                        </th>
                        <td>
                            {{ $userAttendance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.course') }}
                        </th>
                        <td>
                            {{ $userAttendance->course->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.attendance_design') }}
                        </th>
                        <td>
                            {{ $userAttendance->attendance_design->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.lecture') }}
                        </th>
                        <td>
                            {{ $userAttendance->lecture }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.percentage') }}
                        </th>
                        <td>
                            {{ $userAttendance->percentage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.attend_time') }}
                        </th>
                        <td>
                            {{ $userAttendance->attend_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAttendance.fields.leave_time') }}
                        </th>
                        <td>
                            {{ $userAttendance->leave_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection