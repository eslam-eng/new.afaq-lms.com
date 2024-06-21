@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointTypeValue.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.point-type-values.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTypeValue.fields.id') }}
                        </th>
                        <td>
                            {{ $pointTypeValue->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTypeValue.fields.point_type') }}
                        </th>
                        <td>
                            {{ app()->getLocale() == 'en' ? $pointTypeValue->point_type->name_en ?? '' : $pointTypeValue->point_type->name_ar ?? '' }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTypeValue.fields.give_point') }}
                        </th>
                        <td>
                            {{ $pointTypeValue->give_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTypeValue.fields.get_point') }}
                        </th>
                        <td>
                            {{ $pointTypeValue->get_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTypeValue.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointTypeValue::STATUS_SELECT[$pointTypeValue->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.point-type-values.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
