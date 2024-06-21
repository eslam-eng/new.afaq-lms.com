@extends('layouts.admin')
@section('content')
@can('founder_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.founders.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.founder.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.founder.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Founder">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.name_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.title_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.title_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.founder.fields.department') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($founders as $key => $founder)
                    <tr data-entry-id="{{ $founder->id }}">
<td></td>
                        <td>
                            {{ $founder->id ?? '' }}
                        </td>
                        <td>
                            {{ $founder->name_ar ?? '' }}
                        </td>
                        <td>
                            {{ $founder->name_en ?? '' }}
                        </td>
                        <td>
                            {{ $founder->title_ar ?? '' }}
                        </td>
                        <td>
                            {{ $founder->title_en ?? '' }}
                        </td>
                        <td>
                            @if($founder->image)
                            <a href="{{ $founder->image->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $founder->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ App\Models\Founder::DEPARTMENT_SELECT[$founder->department] ?? '' }}
                        </td>
                        <td>
                            @can('founder_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.founders.show', $founder->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('founder_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.founders.edit', $founder->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('founder_delete')
                            <form action="{{ route('admin.founders.destroy', $founder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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