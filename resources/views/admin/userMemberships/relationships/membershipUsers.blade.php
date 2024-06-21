@can('user_create')

@endcan

<div class="card">


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-membershipUsers">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr data-entry-id="{{ $user->id }}">

                        <td>
                            {{ $user->id ?? '' }}
                        </td>
                        <td>
                            {{ $user->full_name_en ?? '' }}
                        </td>
                        <td>
                            {{ $user->email ?? '' }}
                        </td>


                        <td>
                            @can('user_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            {{-- @can('user_edit')--}}
                            {{-- <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">--}}
                            {{-- {{ trans('global.edit') }}--}}
                            {{-- </a>--}}
                            {{-- @endcan--}}

                            {{-- @can('user_delete')--}}
                            {{-- <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
                            {{-- <input type="hidden" name="_method" value="DELETE">--}}
                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{-- <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">--}}
                            {{-- </form>--}}
                            {{-- @endcan--}}

                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>