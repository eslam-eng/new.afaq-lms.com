@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-methods.index') }}">
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
                            {{ $paymentMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.name_en') }}
                        </th>
                        <td>
                            {{ $paymentMethod->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $paymentMethod->name_ar }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.provider_image') }}
                        </th>
                        <td>
                            @if($paymentMethod->provider_image)
                                <a href="{{ $paymentMethod->provider_image }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $paymentMethod->provider_image }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.local_image') }}
                        </th>
                        <td>
                            @if($paymentMethod->local_image)
                                <a href="{{ $paymentMethod->local_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $paymentMethod->local_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.provider') }}
                        </th>
                        <td>
                            {{ App\Models\PaymentMethod::PROVIDER_SELECT[$paymentMethod->provider] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.provider_method') }}
                        </th>
                        <td>
                            {{ $paymentMethod->provider_method_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.service_fees') }}
                        </th>
                        <td>
                            {{ $paymentMethod->service_fees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\PaymentMethod::TYPE_SELECT[$paymentMethod->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.mode') }}
                        </th>
                        <td>
                            {{ $paymentMethod->mode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PaymentMethod::STATUS_SELECT[$paymentMethod->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
