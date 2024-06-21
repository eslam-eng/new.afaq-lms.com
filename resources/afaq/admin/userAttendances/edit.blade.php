@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userAttendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-attendances.update", [$userAttendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userAttendance.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userAttendance->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="course_id">{{ trans('cruds.userAttendance.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id">
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $userAttendance->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attendance_design_id">{{ trans('cruds.userAttendance.fields.attendance_design') }}</label>
                <select class="form-control select2 {{ $errors->has('attendance_design') ? 'is-invalid' : '' }}" name="attendance_design_id" id="attendance_design_id">
                    @foreach($attendance_designs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('attendance_design_id') ? old('attendance_design_id') : $userAttendance->attendance_design->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attendance_design'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendance_design') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.attendance_design_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lecture">{{ trans('cruds.userAttendance.fields.lecture') }}</label>
                <input class="form-control {{ $errors->has('lecture') ? 'is-invalid' : '' }}" type="number" name="lecture" id="lecture" value="{{ old('lecture', $userAttendance->lecture) }}" step="1">
                @if($errors->has('lecture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lecture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.lecture_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="percentage">{{ trans('cruds.userAttendance.fields.percentage') }}</label>
                <input class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}" type="number" name="percentage" id="percentage" value="{{ old('percentage', $userAttendance->percentage) }}" step="0.01">
                @if($errors->has('percentage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('percentage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.percentage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attend_time">{{ trans('cruds.userAttendance.fields.attend_time') }}</label>
                <input class="form-control datetime {{ $errors->has('attend_time') ? 'is-invalid' : '' }}" type="text" name="attend_time" id="attend_time" value="{{ old('attend_time', $userAttendance->attend_time) }}">
                @if($errors->has('attend_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attend_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.attend_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leave_time">{{ trans('cruds.userAttendance.fields.leave_time') }}</label>
                <input class="form-control datetime {{ $errors->has('leave_time') ? 'is-invalid' : '' }}" type="text" name="leave_time" id="leave_time" value="{{ old('leave_time', $userAttendance->leave_time) }}">
                @if($errors->has('leave_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leave_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAttendance.fields.leave_time_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection