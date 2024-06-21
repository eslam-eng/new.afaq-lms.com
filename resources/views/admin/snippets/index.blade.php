@extends('layouts.admin')
@section('content')
@can('snippet_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.snippets.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.snippet.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.snippet.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Snippet">
                <thead>
                    <tr>
<th></th>
                        <th>
                            {{ trans('cruds.snippet.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.snippet.fields.slug') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($snippets as $key => $snippet)
                    <tr data-entry-id="{{ $snippet->id }}">
<td></td>
                        <td>
                            {{ $snippet->id ?? '' }}
                        </td>
                        <td>
                            {{ $snippet->slug ?? '' }}
                        </td>
                        <td>
                            @can('snippet_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.snippets.show', $snippet->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('snippet_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.snippets.edit', $snippet->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('snippet_delete')
                            <form action="{{ route('admin.snippets.destroy', $snippet->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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