@extends('layouts.admin')
@section('content')
@can('lecture_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.lectures.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.lecture.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.lecture.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Lecture">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.instructor') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lectures as $key => $lecture)
                    <tr data-entry-id="{{ $lecture->id }}">
<td></td>
                        <td>
                            {{ $lecture->id ?? '' }}
                        </td>
                        <td>
                            {{ $lecture->name ?? '' }}
                        </td>
                        <td>
                            {{ $lecture->date ?? '' }}
                        </td>
                        <td>
                            {{ $lecture->instructor ?? '' }}
                        </td>
                        <td>
                            @can('lecture_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.lectures.show', $lecture->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('lecture_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.lectures.edit', $lecture->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('lecture_delete')
                            <form action="{{ route('admin.lectures.destroy', $lecture->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection