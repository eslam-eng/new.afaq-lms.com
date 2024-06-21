@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $businessPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.user') }}
                        </th>
                        <td>
                            {{ $businessPayment->user_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $businessPayment->payment_method_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package_name_en') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->package_name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package_name_ar') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->package_name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.price_package_annual') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->price_package_annual }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package_annual_price_offers') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->package_annual_price_offers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.price_package_month') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->price_package_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package_month_price_offers') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->package_month_price_offers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_number') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->event_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.speakers_number') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->speakers_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.attendance_trainees_number') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->attendance_trainees_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.remote_trainees_number') }}
                        </th>
                        <td>
                            {{ $businessPayment->package->remote_trainees_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.electronic_registration_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->electronic_registration_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.e_certificate') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->e_certificate ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.customize_event_with_host_identity') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->customize_event_with_host_identity ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.digital_marketing_event') }}
                        </th>
                        <td>
                            {{ App\Models\BusinessPayment::DIGITAL_MARKETING_EVENT_SELECT[$businessPayment->package->digital_marketing_event] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.advertising_afaq_core') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->advertising_afaq_core ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.quality_control_inquiries') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->quality_control_inquiries ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.help_center_customer_response') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->help_center_customer_response ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.technical_support') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->technical_support ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_accreditation') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->event_accreditation ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_free_collection') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->event_free_collection ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.e_certificate_speaker') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->e_certificate_speaker ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.two_email_trainees') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->two_email_trainees ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.target_groups_mails') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->target_groups_mails ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.electronic_testing_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->electronic_testing_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.effectiveness_rating_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->effectiveness_rating_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.discount_free_coupon') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->discount_free_coupon ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_reports') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->event_reports ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.attendance_absence_qr_system') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->attendance_absence_qr_system ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.printable_id_card') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->printable_id_card ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.conference_workshops_attendance') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->conference_workshops_attendance ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.send_messages_event_participants') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->send_messages_event_participants ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.event_notification_mobile') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->event_notification_mobile ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.fixed_advertising_banner') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->fixed_advertising_banner ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.responsible_employee_manage_event') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $businessPayment->package->responsible_employee_manage_event ? 'checked' : '' }}>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.initial_response') }}
                        </th>
                        <td>
                            {{ $businessPayment->initial_response }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.status_response') }}
                        </th>
                        <td>
                            {{ $businessPayment->status_response }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.payment_number') }}
                        </th>
                        <td>
                            {{ $businessPayment->payment_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.package_price_type') }}
                        </th>
                        <td>
                            {{ App\Models\BusinessPayment::PACKAGE_PRICE_TYPE_SELECT[$businessPayment->package_price_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.price') }}
                        </th>
                        <td>
                            {{ $businessPayment->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessPayment.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\BusinessPayment::STATUS_RADIO[$businessPayment->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
