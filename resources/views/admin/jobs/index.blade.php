@extends('layouts.admin')
@section('content')
@can('job_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.jobs.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.job.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Job">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.title') }}
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $key => $job)
                    <tr data-entry-id="{{ $job->id }}">
<td></td>
                        <td>
                            {{ $job->id ?? '' }}
                        </td>
                        <td>
                            {{ $job->title ?? '' }}
                        </td>
                        <td>
                            @can('job_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.jobs.show', $job->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('job_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.jobs.edit', $job->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('job_delete')
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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