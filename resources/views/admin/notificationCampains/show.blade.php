@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.notificationCampain.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notification-campains.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.id') }}
                        </th>
                        <td>
                            {{ $notificationCampain->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.specialty') }}
                        </th>
                        <td>
                            {{ $notificationCampain->specialty->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.title_en') }}
                        </th>
                        <td>
                            {{ $notificationCampain->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $notificationCampain->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.message_en') }}
                        </th>
                        <td>
                            {{ $notificationCampain->message_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.message_ar') }}
                        </th>
                        <td>
                            {{ $notificationCampain->message_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\NotificationCampain::TYPE_SELECT[$notificationCampain->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.send_at') }}
                        </th>
                        <td>
                            {{ $notificationCampain->send_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notificationCampain.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\NotificationCampain::STATUS_RADIO[$notificationCampain->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notification-campains.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection