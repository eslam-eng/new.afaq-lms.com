@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contentCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
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
                            {{ $contentCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.name') }}
                        </th>
                        <td>
                            {{ app()->getLocale() == 'en' ? $contentCategory->name : $contentCategory->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.slug') }}
                        </th>
                        <td>
                            {{ $contentCategory->slug }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\ContentCategory::TYPE_SELECT[$contentCategory->type] ?? '' }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
