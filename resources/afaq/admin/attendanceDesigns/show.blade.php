@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attendanceDesign.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-designs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesign.fields.id') }}
                        </th>
                        <td>
                            {{ $attendanceDesign->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesign.fields.name_en') }}
                        </th>
                        <td>
                            {{ $attendanceDesign->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesign.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $attendanceDesign->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesign.fields.image') }}
                        </th>
                        <td>
                            @if($attendanceDesign->image)
                                <a href="{{ $attendanceDesign->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $attendanceDesign->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceDesign.fields.templete') }}
                        </th>
                        <td>
                            {!! $attendanceDesign->templete !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-designs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection