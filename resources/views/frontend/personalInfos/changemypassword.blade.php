@extends('frontend.personalInfos.index')
@section('myprofile')
<style>
  @media screen and (max-width: 830px) {
    .precemp {
      bottom: 30px;
    }
  }
</style>
<div class="myprofile-page">
  <div class="changepassword-myprofile-page">
    <div class=" myprofile-title">
      <h3> {{__('lms.change_password')}}</h3>
    </div>
    <div class="changemypassword-lms">

      <form method="POST" action="{{url(app()->getLocale().'/changemypassword')}}">
        @csrf

        <div class="form-group required">
          <label class="control-label" for="old_password">{{__('lms.old_password')}}</label>
          <div class="d-flex justify-content-between align-items-center required" style="padding: 0 10px;">
            <input type="password" id="old_password" class="form-control"  required name="old_password">
            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label" for="new_password">{{__('lms.new_password')}}</label>
          <div class="d-flex justify-content-between align-items-center required" style="padding: 0 10px;">
            <input type="password" id="new_password" class="form-control"  required name="new_password">
            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label" for="confirm_new_password">{{__('lms.confirm_new_password')}}</label>
          <div class="d-flex justify-content-between align-items-center" style="padding: 0 10px;">
            <input type="password" id="confirm_new_password" class="form-control" required  name="confirm_new_password">
            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
          </div>
        </div>

        <div class="btn-save-password mt-4">
          <div class="lms-buy-nd d-flex justify-content-center align-items-center">
            <button type="submit" name="submit" class="subscribe-lms">{{__('lms.Save')}}</button>
            <button class="buy-lms d-flex align-items-center">
              {{__('lms.Cancel')}}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection