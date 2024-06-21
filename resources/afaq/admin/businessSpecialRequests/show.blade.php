@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessSpecialRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-special-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.event_type') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->event_type->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.number_of_attendees') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->number_of_attendees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.event_starting_date') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->event_starting_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.details') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.full_name') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.employer') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->employer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.job_title') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->job_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.email_address') }}
                        </th>
                        <td>
                            {{ $businessSpecialRequest->email_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessSpecialRequest.fields.accept_terms') }}
                        </th>
                        <td>
                            {{ App\Models\BusinessSpecialRequest::ACCEPT_TERMS_RADIO[$businessSpecialRequest->accept_terms] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-special-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection