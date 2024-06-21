{{--{{dd($enrollment_payments)}}--}}
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>

                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $enrollment_payments->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.payments_number') }}
                        </th>
                        <td>
                            {{ $enrollment_payments->payment_number }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.transaction') }}
                        </th>
                        <td>
                            {{ $enrollment_payments->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.amount') }}
                        </th>
                        <td>
                            {{ $enrollment_payments->amount }}

                        </td>
                    </tr>




                    </tbody>
                </table>
            </div>
        </div>
    </div>



