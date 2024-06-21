@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.iconTextDe.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icon-text-des.index') }}">
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
                            {{ $iconTextDe->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.text_en') }}
                        </th>
                        <td>
                            {{ $iconTextDe->text_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.text_ar') }}
                        </th>
                        <td>
                            {{ $iconTextDe->text_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.description_en') }}
                        </th>
                        <td>
                            {!! $iconTextDe->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $iconTextDe->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.link_en') }}
                        </th>
                        <td>
                            {{ $iconTextDe->link_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.link_ar') }}
                        </th>
                        <td>
                            {{ $iconTextDe->link_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iconTextDe.fields.icon') }}
                        </th>
                        <td>
                            @if($iconTextDe->icon)
                                <a href="{{ $iconTextDe->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $iconTextDe->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.icon-text-des.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection