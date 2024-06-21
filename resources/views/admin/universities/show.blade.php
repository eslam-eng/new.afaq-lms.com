@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.university.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.universities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.university.fields.id') }}
                        </th>
                        <td>
                            {{ $university->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.university.fields.name_en') }}
                        </th>
                        <td>
                            {{ $university->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.university.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $university->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.university.fields.logo') }}
                        </th>
                        <td>
                            @if($university->logo)
                                <a href="{{ $university->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $university->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.universities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection