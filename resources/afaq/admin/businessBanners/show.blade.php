@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessBanner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-banners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.id') }}
                        </th>
                        <td>
                            {{ $businessBanner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.title_en') }}
                        </th>
                        <td>
                            {{ $businessBanner->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $businessBanner->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.description_en') }}
                        </th>
                        <td>
                            {!! $businessBanner->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $businessBanner->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.short_description_en') }}
                        </th>
                        <td>
                            {{ $businessBanner->short_description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessBanner.fields.short_description_ar') }}
                        </th>
                        <td>
                            {{ $businessBanner->short_description_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-banners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection