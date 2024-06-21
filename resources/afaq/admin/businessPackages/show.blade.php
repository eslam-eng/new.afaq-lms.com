@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessPackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $businessPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.package_name_en') }}
                        </th>
                        <td>
                            {{ $businessPackage->package_name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.package_name_ar') }}
                        </th>
                        <td>
                            {{ $businessPackage->package_name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.hybrid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->hybrid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.onsite') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->onsite ? 'checked' : '' }}>
                        </td>
                    </tr>

{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.businessPackage.fields.price_package_annual') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $businessPackage->price_package_annual }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.businessPackage.fields.package_annual_price_offers') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $businessPackage->package_annual_price_offers }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.price_package_month') }}
                        </th>
                        <td>
                            {{ $businessPackage->price_package_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.package_month_price_offers') }}
                        </th>
                        <td>
                            {{ $businessPackage->package_month_price_offers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_number') }}
                        </th>
                        <td>
                            {{ $businessPackage->event_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_number_days') }}
                        </th>
                        <td>
                            {{$businessPackage->event_number_days}}
                        </td>

                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.speakers_number') }}
                        </th>
                        <td>
                            {{ $businessPackage->speakers_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.attendance_trainees_number') }}
                        </th>
                        <td>
                            {{ $businessPackage->attendance_trainees_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.remote_trainees_number') }}
                        </th>
                        <td>
                            {{ $businessPackage->remote_trainees_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.electronic_registration_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->electronic_registration_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.e_certificate') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->e_certificate ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.customize_event_with_host_identity') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->customize_event_with_host_identity ? 'checked' : '' }}>
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.businessPackage.fields.digital_marketing_event') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ App\Models\BusinessPackage::DIGITAL_MARKETING_EVENT_SELECT[$businessPackage->digital_marketing_event] ?? '' }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.digital_marketing_event') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->digital_marketing_event ? 'checked' : '' }}>
                        </td>
                    </tr>


                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_fees') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->event_fees ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.advertising_afaq_core') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->advertising_afaq_core ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.quality_control_inquiries') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->quality_control_inquiries ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.help_center_customer_response') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->help_center_customer_response ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.technical_support') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->technical_support ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_accreditation') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->event_accreditation ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_free_collection') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->event_free_collection ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.e_certificate_speaker') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->e_certificate_speaker ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.two_email_trainees') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->two_email_trainees ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.target_groups_mails') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->target_groups_mails ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.electronic_testing_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->electronic_testing_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.effectiveness_rating_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->effectiveness_rating_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.discount_free_coupon') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->discount_free_coupon ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_reports') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->event_reports ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.attendance_absence_qr_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->attendance_absence_qr_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.printable_id_card') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->printable_id_card ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.conference_workshops_attendance') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->conference_workshops_attendance ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.send_messages_event_participants') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->send_messages_event_participants ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.event_notification_mobile') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->event_notification_mobile ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.fixed_advertising_banner') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->fixed_advertising_banner ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPackage.fields.responsible_employee_manage_event') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPackage->responsible_employee_manage_event ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
