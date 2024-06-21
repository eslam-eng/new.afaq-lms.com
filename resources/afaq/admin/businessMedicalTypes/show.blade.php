@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.businessMedicalType.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.business-medical-types.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.id') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.medical_header_en') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->medical_header_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.medical_header_ar') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->medical_header_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.title_en') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.short_description_en') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->short_description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.short_description_ar') }}
                        </th>
                        <td>
                            {{ $businessMedicalType->short_description_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessMedicalType.fields.image') }}
                        </th>
                        <td>
                            @foreach($businessMedicalType->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.business-medical-types.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
