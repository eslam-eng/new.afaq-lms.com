@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accreditationSponsor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accreditation-sponsors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $accreditationSponsor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.name_en') }}
                        </th>
                        <td>
                            {{ $accreditationSponsor->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $accreditationSponsor->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.logo') }}
                        </th>
                        <td>
                            @if($accreditationSponsor->logo)
                                <a href="{{ $accreditationSponsor->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $accreditationSponsor->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accreditation-sponsors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection