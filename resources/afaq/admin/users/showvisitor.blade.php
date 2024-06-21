@extends('layouts.admin')
@section('content')
@php
$user_roles_arr = $user->roles->toArray();
@endphp
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="javascript:history.back()">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.birth_date') }}
                        </th>
                        <td>
                            {{ $user->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <td>
                            {{ $user->country }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="col-lg-12" style="display: flex" >
                <div class="col-lg-2">
                    <select class="form-control " id="select_action" required>
                        <option value="Unchecked" {{ old('status', $user->status) === 'Unchecked' ? 'selected' : '' }}>Unchecked</option>
                        <option value="Approve" {{ old('status', $user->status) === 'Approve' ? 'selected' : '' }}>Approve</option>
                        <option value="Refused" {{ old('status', $user->status) === 'Refused' ? 'selected' : '' }}>Refused</option>
                        <option value="Pending" {{ old('status', $user->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Withdrawal" {{ old('status', $user->status) === 'Withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <input id="Reason" class="form-control"  placeholder="Please add A reasons" type="hidden"  value="{{ old('reason', $user->reason) }}" />
                </div>
                <button class="btn btn-danger " id="approval" type="submit" >
                    {{ trans('global.save') }}
                </button>
            </div>
        </br>
            @foreach( Auth::user()->roles as $roles)
                @if($roles['title']=='CEO' && $user_roles_arr[0]['id']!=7 )
                    @if($user->status == 'Refused' || $user->status == 'Withdrawal' )
                        <button class="btn btn-success  col-lg-5 offset-3" id="confirmDisApproval" type="submit" >
                            Confirm {{ $user->status }} and send Email To student
                        </button>
                    @endif
                @endif
            @endforeach

        <!-- Image loader -->
            <div id='loader' class="offset-4 " style='display: none;'>
                <img src="{{ asset('reload.gif') }}" width='150px' height='150px'>
            </div>
            <!-- Image loader -->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.user_log.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_payments">
            @includeIf('admin.users.relationships.userPayments', ['payments' => $user->userPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_logs">
            @includeIf('admin.users.relationships.userUserLogs', ['userLogs' => $user_logs])
        </div>
    </div>
</div>

@endsection
@section('scripts')
 <script>
    $('#select_action').change(function(){
        var val =$(this).val();
        if(val=='Refused'||val=='Pending'||val=='Withdrawal'){
            $('#Reason').attr('type','text');
        }else {
            $('#Reason').attr('type','hidden');
        }
    });
    $('#approval').click(function(){
        var val =$('#select_action').val();
        $('#approval').attr('disabled',true);
        if(val=='Refused'||val=='Pending'||val=='Withdrawal'){
            if($('#Reason').val()==''){
              return  alert('Please add a reason');
            }
        }
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.users.approval') }}',
            data:'userID={{ $user->id }}&selection= '+$('#select_action').val()+'&reason='+$('#Reason').val(),
            beforeSend: function(){
                // Show image container
                $("#loader").show();
                // return false;
            },
            success:function(data) {
                // location.reload();
                console.log(data)
                return false;
            }
        });
    })

   
   
    $('#confirmDisApproval').click(function(){
        $('#confirmDisApproval').attr('disabled',true);
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.users.disapproval') }}',
            data:'userID={{ $user->id }}',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success:function(data) {
                location.reload();

            }
        });
    })
    @if($user->status == 'Refused'||$user->status == 'Pending'||$user->status == 'Withdrawal')
    $('#Reason').attr('type','text');
    @endif
  
</script>
@endsection

