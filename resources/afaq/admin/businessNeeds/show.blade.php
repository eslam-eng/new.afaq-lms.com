@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessNeed.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-needs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessNeed.fields.id') }}
                        </th>
                        <td>
                            {{ $businessNeed->id }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.businessNeed.fields.icon') }}
                        </th>
                        <td>
                            @if($businessNeed->icon)
                                <a href="{{ $businessNeed->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $businessNeed->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessNeed.fields.short_description_en') }}
                        </th>
                        <td>
                            {{ $businessNeed->short_description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessNeed.fields.short_description_ar') }}
                        </th>
                        <td>
                            {{ $businessNeed->short_description_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-needs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
