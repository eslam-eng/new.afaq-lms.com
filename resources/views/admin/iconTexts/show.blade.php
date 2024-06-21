@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.iconText.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icon-texts.index') }}">
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
                            {{ $iconText->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconText.fields.title_en') }}
                        </th>
                        <td>
                            {{ $iconText->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconText.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $iconText->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconText.fields.image') }}
                        </th>
                        <td>
                            @if($iconText->image)
                                <a href="{{ $iconText->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $iconText->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icon-texts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection