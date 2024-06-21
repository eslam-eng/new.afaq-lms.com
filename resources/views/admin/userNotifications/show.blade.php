@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.userNotification.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.user-notifications.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.id') }}
                        </th>
                        <td>
                            {{ $userNotification->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.parent') }}
                        </th>
                        <td>
                            {{ $userNotification->parent_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.user') }}
                        </th>
                        <td>
                            {{ $userNotification->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.type') }}
                        </th>
                        <td>
                            {{ $userNotification->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.title') }}
                        </th>
                        <td>
                            {{ $userNotification->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.message') }}
                        </th>
                        <td>
                            {{ $userNotification->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.data') }}
                        </th>
                        <td>
                            {{ $userNotification->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\UserNotification::STATUS_RADIO[$userNotification->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.read') }}
                        </th>
                        <td>
                            {{ App\Models\UserNotification::READ_RADIO[$userNotification->read] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userNotification.fields.fcm_token') }}
                        </th>
                        <td>
                            {{ $userNotification->fcm_token }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.user-notifications.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
