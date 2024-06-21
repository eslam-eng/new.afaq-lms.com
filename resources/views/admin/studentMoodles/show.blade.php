@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentMoodle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-moodles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.id') }}
                        </th>
                        <td>
                            {{ $studentMoodle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.name') }}
                        </th>
                        <td>
                            {{ $studentMoodle->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.email') }}
                        </th>
                        <td>
                            {{ $studentMoodle->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.mobile') }}
                        </th>
                        <td>
                            {{ $studentMoodle->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMoodle.fields.image') }}
                        </th>
                        <td>
                            @if($studentMoodle->image)
                                <a href="{{ $studentMoodle->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $studentMoodle->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-moodles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection