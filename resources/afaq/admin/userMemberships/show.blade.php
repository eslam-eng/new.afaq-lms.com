@extends('layouts.admin')
@section('content')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>--}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js">

    </script>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userMembership.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.id') }}
                        </th>
                        <td>
                            {{ $userMembership->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.user') }}
                        </th>
                        <td>
                            {{ $userMembership->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.member_type') }}
                        </th>
                        <td>
                            {{ $userMembership->member_type->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.accreditation_number') }}
                        </th>
                        <td>
                            {{ $userMembership->accreditation_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.start_date') }}
                        </th>
                        <td>
                            {{ $userMembership->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.end_date') }}
                        </th>
                        <td>
                            {{ $userMembership->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.file') }}
                        </th>
                        <td>
                            @if($userMembership->file)
                                <a href="{{ $userMembership->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMembership.fields.status') }}
                        </th>
                        <td>
                            <input  data-id="{{$userMembership->id}}" onchange="change_status()" id="status" class="toggle-class" type="checkbox" data-onstyle="success"
                                    data-offstyle="danger" data-toggle="toggle" data-off="Un Active" data-on="Active" {{ $userMembership->status == 1 ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#membership_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="membership_users">

            @includeIf('admin.userMemberships.relationships.membershipUsers', ['user' => $userMembership->user])
{{--            {{dd($userMembership->toArray())}}--}}
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        function change_status(){
            var status = $("#status").prop('checked') == true ? 1 : 0;
            var userMembership_id = $("#status").data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/ChangeStatusUserMembership',
                data: {'status': status, 'userMembership_id': userMembership_id},
                success: function(data){}
            });
        }

    </script>
@endsection
