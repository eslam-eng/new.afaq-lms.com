@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
{{--            <div class="form-group">--}}
{{--                <a class="btn btn-default" href="{{ route('admin.payments.index') }}">--}}
{{--                    {{ trans('global.back_to_list') }}--}}
{{--                </a>--}}
{{--            </div>--}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $payment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payment.fields.transaction') }}
                        </th>
                        <td>
                            {{ $payment->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payment.fields.amount') }}
                        </th>
                        <td>
                            {{ $payment->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <td>
                            {{ $payment->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payment.fields.user') }}
                        </th>
                        <td>
                            {{ $payment->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ url()->previous() }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
