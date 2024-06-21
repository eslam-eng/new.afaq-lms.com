@extends('layouts.admin')
@section('content')
@can('coming_soon_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.coming-soons.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.comingSoon.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.comingSoon.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ComingSoon">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.comingSoon.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comingSoons as $key => $comingSoon)
                    <tr data-entry-id="{{ $comingSoon->id }}">
<td></td>
                        <td>
                            {{ $comingSoon->id ?? '' }}
                        </td>
                        <td>
                            {{ $comingSoon->title ?? '' }}
                        </td>
                        <td>
                            @can('coming_soon_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.coming-soons.show', $comingSoon->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('coming_soon_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.coming-soons.edit', $comingSoon->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('coming_soon_delete')
                            <form action="{{ route('admin.coming-soons.destroy', $comingSoon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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