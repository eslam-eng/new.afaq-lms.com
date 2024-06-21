{{--{{dd($reservation_payments)}}--}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderPayments">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.course') }}
                        </th>

                        <th>
                            {{ trans('cruds.reservation.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.payments_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.offer') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.final_price') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservation_payments as $reservation_payment)
                    <tr data-entry-id="{{ $reservation_payment->payment_id }}">
                        <td></td>
                        <td>
                            {{ $reservation_payment->payment_id ?? '' }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $reservation_payment->course_name_en ?? '' : $reservation_payment->course_name_ar ?? ''}}
                        </td>

                        <td>
                            {{app()->getLocale()=='en' ?  $reservation_payment->user_name_en ?? '' : $reservation_payment->user_name_ar ?? ''}}
                        </td>
                        <td>
                            {{ $reservation_payment->payment_number }}
                        </td>
                        <td>
                            {{ $reservation_payment->price }}
                        </td>
                        <td>
                            {{ $reservation_payment->offer }}
                        </td>
                        <td>
                            {{ $reservation_payment->final_price }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
