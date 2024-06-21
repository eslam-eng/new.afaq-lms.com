@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attendanceDesignKey.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-design-keys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesignKey.fields.id') }}
                        </th>
                        <td>
                            {{ $attendanceDesignKey->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesignKey.fields.key') }}
                        </th>
                        <td>
                            {{ $attendanceDesignKey->key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesignKey.fields.description') }}
                        </th>
                        <td>
                            {{ $attendanceDesignKey->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-design-keys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection