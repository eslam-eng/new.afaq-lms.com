@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cancelPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancel-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $cancelPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.payment') }}
                        </th>
                        <td>
                            {{ $cancelPayment->payment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.invoice') }}
                        </th>
                        <td>
                            {{ $cancelPayment->invoice }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.user') }}
                        </th>
                        <td>
                            {{ $cancelPayment->user }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CancelPayment::STATUS_RADIO[$cancelPayment->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelPayment.fields.approved') }}
                        </th>
                        <td>
                            {{ App\Models\CancelPayment::APPROVED_SELECT[$cancelPayment->approved] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancel-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection