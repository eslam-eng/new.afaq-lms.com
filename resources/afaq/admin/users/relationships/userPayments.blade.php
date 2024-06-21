<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userPayments">
                <thead>
                    <tr>
<th></th>
                        <th>
                            {{ trans('cruds.payment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.user') }}
                        </th>
                        <th>
                            {{ trans('lms.courses') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
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
                            {{ $payment->user->full_name_en ?? '' }}
                        </td>
                        <td>
                            {{ json_encode($payment->payment_details->pluck('course_name_en'), JSON_UNESCAPED_UNICODE); }}
                        </td>
                        <td>
                            {{ $payment->transaction ?? '' }}
                        </td>
                        <td>
                            {{ $payment->status ?? '' }}
                        </td>
                        <td>
                            @can('payment_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.payments.show', $payment->id) }}">
                                {{ trans('global.view') }}
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
