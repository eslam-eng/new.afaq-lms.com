@extends('layouts.admin')
@section('content')
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
                            {{ trans('cruds.user.fields.full_name_en') }}
                        </th>
                        <td>
                            {{ $user->full_name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.full_name_ar') }}
                        </th>
                        <td>
                            {{ $user->full_name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('frontend.register.Title') }}
                        </th>
                        <td>
                            {{ $user->name_title }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('frontend.register.gender') }}
                        </th>
                        @if($user->gender == 'male')
                        <td>

                            {{app()->getLocale()=='ar'?'ذكر':'Male'}}
                        </td>
                        @else
                        <td>

                            {{app()->getLocale()=='ar'?'أنثي':'Female'}}
                        </td>
                        @endif
                    </tr>

                    <tr>
                        <th>
                            {{ trans('frontend.register.nationality') }}
                        </th>
                        <td>
                            {{ app()->getLocale() == 'en' ?  $user->country_and_nationality->country_enNationality ?? '' :$user->country_and_nationality->country_arNationality  ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('frontend.register.identity_type') }}
                        </th>
                        @if( $user->identity_type == 'national_id')
                        <td>
                            {{__('frontend.national_id')}}
                        </td>
                        @elseif($user->identity_type == 'resident_id')
                        <td>
                            {{__('frontend.resident_id')}}
                        </td>
                        @elseif($user->identity_type == 'passport')
                        <td>
                            {{__('frontend.passport')}}
                        </td>
                        @elseif($user->identity_type == 'non_resident')
                        <td>
                            {{__('frontend.non_resident')}}
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>
                            {{ trans('frontend.register.identity_number') }}
                        </th>
                        <td>
                            {{ $user->identity_number }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('frontend.register.Field of your specialist study') }}
                        </th>
                        <td>
                            {{ app()->getLocale() == 'en' ?  $user->specialty->name_en ?? '' :$user->specialty->name_ar  ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('frontend.register.Field of your sub specialist study') }}
                        </th>
                        <td>
                            {{ app()->getLocale() == 'en' ?  $user->SubSpecialty->name_en ?? '' :$user->SubSpecialty->name_ar  ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('frontend.register.occupational_classification_number') }}
                        </th>
                        <td>
                            {{ $user->occupational_classification_number }}
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
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.personal_photo') }}
                        </th>
                        <td>
                            @if($user->personal_photo)
                            <a href="{{ $user->personal_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $user->personal_photo->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
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
            <a class="nav-link" href="#user_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.courseInvoice.fields.user_invoice') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_certificates" role="tab" data-toggle="tab">
                {{ trans('cruds.certificat.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_exams" role="tab" data-toggle="tab">
                {{ trans('cruds.exam.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_memberships" role="tab" data-toggle="tab">
                {{ trans('cruds.userMembership.title_singular') }}
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
        <div class="tab-pane" role="tabpanel" id="user_invoices">
            @includeIf('admin.users.relationships.userInvoices', ['courseInvoices' => $user->userInvoices])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_courses">
            @includeIf('admin.users.relationships.userCourses', ['courses' => $user->courses])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_certificates">
            @includeIf('admin.users.relationships.userCertificates', ['certificates' => $user->certificates])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_exams">
            @includeIf('admin.users.relationships.userExams', ['exams' => $user->userExams])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_memberships">
            @includeIf('admin.users.relationships.userMemberships', ['userMemberships' => $user->userUserMemberships])
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
