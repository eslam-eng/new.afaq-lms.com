@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subSpecialty.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subSpecialty.fields.id') }}
                        </th>
                        <td>
                            {{ $subSpecialty->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subSpecialty.fields.specialty') }}
                        </th>
                        <td>
                            {{ $subSpecialty->specialty->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subSpecialty.fields.name_en') }}
                        </th>
                        <td>
                            {{ $subSpecialty->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subSpecialty.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $subSpecialty->name_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection