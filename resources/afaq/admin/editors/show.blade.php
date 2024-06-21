@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.editor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.editors.index') }}">
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
                            {{ $editor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.name') }}
                        </th>
                        <td>
                            {{ $editor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.email') }}
                        </th>
                        <td>
                            {{ $editor->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.mobile') }}
                        </th>
                        <td>
                            {{ $editor->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.image') }}
                        </th>
                        <td>
                            @if($editor->image)
                                <a href="{{ $editor->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $editor->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.editors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection