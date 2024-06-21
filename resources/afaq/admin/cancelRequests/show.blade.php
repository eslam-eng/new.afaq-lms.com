@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cancelRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancel-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $cancelRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.course') }}
                        </th>
                        <td>
                            {{ $cancelRequest->course->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.user') }}
                        </th>
                        <td>
                            {{ $cancelRequest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.type') }}
                        </th>
                        <td>
                            {{ $cancelRequest->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.amount') }}
                        </th>
                        <td>
                            {{ $cancelRequest->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CancelRequest::STATUS_RADIO[$cancelRequest->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.approved') }}
                        </th>
                        <td>
                            {{ App\Models\CancelRequest::APPROVED_SELECT[$cancelRequest->approved] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelRequest.fields.cancel_reason') }}
                        </th>
                        <td>
                            {{ $cancelRequest->cancel_reason }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancel-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection