@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.membershipType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.membership-types.index') }}">
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
                            {{ $membershipType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membershipType.fields.name_en') }}
                        </th>
                        <td>
                            {{ $membershipType->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membershipType.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $membershipType->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membershipType.fields.description_en') }}
                        </th>
                        <td>
                            {!! $membershipType->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membershipType.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $membershipType->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membershipType.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\MembershipType::STATUS_RADIO[$membershipType->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.membership-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
