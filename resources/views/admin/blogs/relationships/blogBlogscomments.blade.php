@can('blogscomment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.blogscomments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.blogscomment.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.blogscomment.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-blogBlogscomments">
                <thead>
                    <tr>
                        
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.blog') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.approved') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogscomments as $key => $blogscomment)
                        <tr data-entry-id="{{ $blogscomment->id }}">
                           
                            <td>
                                {{ $blogscomment->id ?? '' }}
                            </td>
                            <td>
                                {{ $blogscomment->blog->title ?? '' }}
                            </td>
                            <td>
                                @if($blogscomment->image)
                                    <a href="{{ $blogscomment->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $blogscomment->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $blogscomment->comment ?? '' }}
                            </td>
                            <td>
                                {{ $blogscomment->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $blogscomment->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $blogscomment->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('blogscomment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.blogscomments.show', $blogscomment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('blogscomment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.blogscomments.edit', $blogscomment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('blogscomment_delete')
                                    <form action="{{ route('admin.blogscomments.destroy', $blogscomment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

