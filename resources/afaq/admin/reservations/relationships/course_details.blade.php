<div class="card">
    {{--{{dd($course_payments->toarray())}}--}}


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderPayments">
                <thead>
                    <tr>
<th></th>
                        <th>
                            {{ trans('cruds.reservation.fields.user') }}
                        </th>
                        {{-- <th>--}}
                        {{-- {{ trans('cruds.reservation.fields.payments_id') }}--}}
                        {{-- </th>--}}
                        <th>
                            {{ trans('cruds.reservation.fields.coupon_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.final_total') }}
                        </th>

                        <th>
                            {{ trans('cruds.reservation.fields.course') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.course_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.payment_provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.provider_payment_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.status') }}
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($course_payments as $course_payment)
                    <tr data-entry-id="{{ $course_payment->id }}">
<td></td>
                        <td>
                            {{$course_payment->user->name ?? ''}}
                        </td>
                        {{-- <td>--}}
                        {{-- {{ $course_payment->payment_id ?? '' }}--}}
                        {{-- </td>--}}
                        <td>
                            {{ $course_payment->coupon_amount }}
                        </td>
                        <td>
                            {{ $course_payment->final_total }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $course_payment->course->name_en ?? '' : $course_payment->course->name_ar ?? ''}}
                        </td>
                        <td>
                            {{ $course_payment->course_price }}
                        </td>
                        <td>
                            {{ $course_payment->payment_provider }}
                        </td>
                        <td>
                            {{ $course_payment->provider_payment_id }}
                        </td>
                        <td>
                            {{ $course_payment->status }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>