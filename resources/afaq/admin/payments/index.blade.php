@extends('layouts.admin')
@section('content')
@can('payment_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.payments.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.payment.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.payment.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.user') }}
                        </th>

                        <th>
                            {{ trans('cruds.payment.fields.transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" style="width: 65px;">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" style="width: 100px;">
                        </td>
                        <td>
                            <select class="search" style="width: 200px;">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                <option value="{{ $item->full_name_en }}">{{ $item->full_name_en }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>

                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                    <tr data-entry-id="{{ $payment->id }}">
                        <td></td>
                        <td>
                            {{ $payment->id ?? '' }}
                        </td>
                        <td>
                            {{ date_format($payment->updated_at,"Y/M/d ")  ?? '' }}
                        </td>
                        <td>
                            @if($payment->payment_type==2)
                            {{ $payment->user->name ?? '' }}
                            @else
                            {{ $payment->user->full_name_en ?? '' }}
                            @endif
                        </td>
                      
                        <td>
                            {{ $payment->transaction ?? '' }}
                        </td>
                        <td>
                            {{ $payment->status ?? '' }}
                        </td>
                        <td>
                            {{ $payment->amount ?? '' }}
                        </td>
                        <td>
                            {{ date_format($payment->updated_at,"Y/M/d ")  ?? '' }}
                        </td>
                        <td>
                            @can('payment_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.payments.show', $payment->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('payment_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.payments.edit', $payment->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan


                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection