@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.system_email.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.system-emails.update", [$system_email->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- *************** Name Dropdown *************** -->
            <div class="form-group">
                <label class="required">Name (the action needed)</label>
                <select class="form-control select2 {{ $errors->has('name_id') ? 'is-invalid' : '' }}" name="name_id" id="name_id">
                    @foreach($system_emails_names as $name_id => $name_info)
                        <option value="{{ $name_id }}" {{ (old('name_id') ? old('name_id') : $system_email->name_id ?? '') == $name_id ? 'selected' : '' }}>{{ $name_info }}</option>
                    @endforeach
                </select>
                @if($errors->has('name_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_id') }}
                    </div>
                @endif
            </div>

            <!-- *************** Type (General - program - lecture) *************** -->
            <div class="form-group">
                <label class="required">Type (Choose if this email content will be for a lecture, a program or General )</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    @foreach($system_emails_types as $type_id => $type_info)
                        <option value="{{ $type_id }}" {{ (old('type') ? old('type') : $system_email->type ?? '') == $type_id ? 'selected' : '' }}>{{ $type_info }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
            <div class="form-group"  id="course">
                <label class="required" for="course_id">{{ trans('cruds.course.title') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" >
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $system_email->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exam.fields.created_at_helper') }}</span>
            </div>

            <div class="form-group"  id="exam">
                <label class="required" for="exam_id">{{ trans('cruds.exam.title') }}</label>
                <select class="form-control select2 {{ $errors->has('exam') ? 'is-invalid' : '' }}" name="exam_id" id="exam_id" >
                    @foreach($exams as $id => $entry)
                        <option value="{{ $id }}" {{ (old('exam_id') ? old('exam_id') : $system_email->exam->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('exam'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exam') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exam.fields.created_at_helper') }}</span>
            </div>
{{--{{dd( ($system_email->id == 8));}}--}}
            @if($system_email->id == 4)
                <div class="form-group">
                    <label class="required" >KeyWords Course Reminder</label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name}    /    {course_name}  /     {course_type}   /     {course_location}" >
                </div>
            @endif

            @if($system_email->id == 8)
                <div class="form-group">
                    <label class="required" >KeyWords Invoice after Course</label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name}    /    {course_name}  /     {invoice_creation_date} " >
                </div>
            @endif
            @if($system_email->id == 6)
                <div class="form-group">
                    <label class="required" >KeyWords Certificate</label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name}    /    {course_name}  /     {course_type} " >
                </div>
            @endif
            @if($system_email->id == 11)
                <div class="form-group">
                    <label class="required" >KeyWords Admin Approve payment </label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name}    /    {course_name}  /     {subscription_date} / {payment_date} " >
                </div>
            @endif
            @if($system_email->id == 10)
                <div class="form-group">
                    <label class="required" >KeyWords Complete Registration </label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name}   " >
                </div>
            @endif
            @if($system_email->id == 2)
                <div class="form-group">
                    <label class="required" >KeyWords verification Email </label>
                    <input readonly class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }} "
                           value="{user_name} / {verified_date} / {email}  " >
                </div>
            @endif

            <div class="form-group">
                <label class="required" for="subject">{{ trans('cruds.system_email.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', $system_email->subject) }}" required>
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.subject_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="message">{{ trans('cruds.system_email.fields.message') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{!! old('message', $system_email->message) !!}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#type').change(function() {
            if ($('#type').val() == '3') {
                $('#course').show();
            } else {
                $('#course').hide();
            }
        });


});
</script>

@endsection
