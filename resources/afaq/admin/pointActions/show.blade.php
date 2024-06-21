@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointAction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.point-actions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.id') }}
                        </th>
                        <td>
                            {{ $pointAction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.user') }}
                        </th>
                        <td>
                            {{ $pointAction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.from_user') }}
                        </th>
                        <td>
                            {{ $pointAction->from_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.amount') }}
                        </th>
                        <td>
                            {{ $pointAction->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.points') }}
                        </th>
                        <td>
                            {{ $pointAction->points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointAction.fields.type') }}
                        </th>
                        <td>
                            {{ $pointAction->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.point-actions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection