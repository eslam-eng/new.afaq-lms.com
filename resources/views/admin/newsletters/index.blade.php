@extends('layouts.admin')
@section('content')
@can('newsletter_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.newsletters.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.newsletter.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.newsletter.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Newsletter">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newsletters as $key => $newsletter)
                    <tr data-entry-id="{{ $newsletter->id }}">
<td></td>
                        <td>
                            {{ $newsletter->id ?? '' }}
                        </td>
                        <td>
                            {{ $newsletter->email ?? '' }}
                        </td>
                        <td>
                            @can('newsletter_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.newsletters.show', $newsletter->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('newsletter_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.newsletters.edit', $newsletter->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('newsletter_delete')
                            <form action="{{ route('admin.newsletters.destroy', $newsletter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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