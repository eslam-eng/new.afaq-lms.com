@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseConfigration.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-configrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseConfigration.fields.id') }}
                        </th>
                        <td>
                            {{ $courseConfigration->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseConfigration.fields.type') }}
                        </th>
                        <td>
                            {{ $courseConfigration->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseConfigration.fields.key') }}
                        </th>
                        <td>
                            {{ $courseConfigration->key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseConfigration.fields.value') }}
                        </th>
                        <td>
                            {{ $courseConfigration->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseConfigration.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CourseConfigration::STATUS_SELECT[$courseConfigration->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-configrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection