@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.membership.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.memberships.index') }}">
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
                            {{ $membership->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.membership_type') }}
                        </th>
                        <td>
                            {{ $membership->membership_type->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.time_type') }}
                        </th>
                        <td>
                            {{ App\Models\Membership::TIME_TYPE_SELECT[$membership->time_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.price') }}
                        </th>
                        <td>
                            {{ $membership->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.link') }}
                        </th>
                        <td>
                            {{ $membership->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection