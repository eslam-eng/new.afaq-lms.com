@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.reservation.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reservations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                {{-- {{dd($payment->payment_details->toArray())}} --}}
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>
                            {{ trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.user_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.course_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.payment_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.status') }}
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $payment->id }}
                            </td>
                            <td>
                                {{ app()->getLocale() == 'en' ? $payment->payment_details->first()->user_name_en ?? '' : $payment->payment_details->first()->user_name_ar ?? '' }}

                            </td>
                            <td>
                                {{ json_encode($payment->payment_details->pluck('course_name_' . app()->getLocale()), JSON_UNESCAPED_UNICODE) }}

                            </td>
                            <td>
                                {{ $payment->payment_number }}
                            </td>
                            <td>
                                {{ $payment->transaction }}
                            </td>
                            <td>
                                {{ $payment->amount }}
                            </td>
                            <td>
                                {{ $payment->status }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <form action="{{ route('admin.reservation.cancel', ['payment_id' => $payment->id]) }}" method="POST">

        <div class="card">

            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">


                {{-- Courses --}}
                <li class="nav-item">
                    <a class="nav-link" href="#courses" role="tab" data-toggle="tab">
                        {{ trans('cruds.course.title') }}
                    </a>
                </li>

            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered   datatable-orderOrderPayments">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        {{ trans('cruds.instructor.fields.id') }}
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
                                    <th>
                                        {{ __('global.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_refound = 0;
                                @endphp
                                @foreach ($payment->payment_details as $payment_detail)
                                    <tr data-entry-id="{{ $payment_detail->payment_id }}" class="table-active">
                                        <td></td>
                                        <td>
                                            {{ $payment_detail->payment_id ?? '' }}
                                        </td>
                                        <td>
                                            {{ app()->getLocale() == 'en' ? $payment_detail->course_name_en ?? '' : $payment_detail->course_name_ar ?? '' }}
                                        </td>

                                        <td>
                                            {{ app()->getLocale() == 'en' ? $payment_detail->user_name_en ?? '' : $payment_detail->user_name_ar ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payment_detail->payment_number }}
                                        </td>
                                        <td>
                                            {{ $payment_detail->price }}
                                        </td>
                                        <td>
                                            {{ $payment_detail->offer }}
                                        </td>
                                        <td>
                                            {{ $payment_detail->final_price }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="payment-checkbox"
                                                data-final-price="{{ $payment_detail->final_price }}"
                                                name="payment_detials[{{ $payment_detail->id }}][id]"
                                                value="{{ $payment_detail->id }}" data-toggle="collapse"
                                                data-target="#accordion-{{ $payment_detail->id }}" class="clickable">
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td colspan="9">
                                            <div id="accordion-{{ $payment_detail->id }}" class="collapse">
                                                @php
                                                    $course_start_date = $payment_detail->course ? $payment_detail->course->start_date : '';
                                                    $refound_value = 0;
                                                    if ($course_start_date) {
                                                        $now = new DateTime(now());
                                                        $course_start_date = new DateTime($course_start_date);
                                                        $days = $course_start_date->diff($now)->format("%a"); //3

                                                        if ($days >= 0) {
                                                            $cancel_policy = \App\Models\CancelationPolicy::where('course_id', $payment_detail->course_id)
                                                                ->whereHas('cancelValue', function ($values) use ($days) {
                                                                    if ($days > 21) {
                                                                        $values->where('days', '>=', 21);
                                                                    } elseif ($days <= 21 && $days > 3) {
                                                                        $values->where('days', '<=', 21)->where('days', '>', 3);
                                                                    } elseif ($days <= 3) {
                                                                        $values->where('days', '<=', 3);
                                                                    }
                                                                })
                                                                ->with([
                                                                    'cancelValue' => function ($values) use ($days) {
                                                                        if ($days > 21) {
                                                                            $values->where('days', '>=', 21);
                                                                        } elseif ($days <= 21 && $days > 3) {
                                                                            $values->where('days', '<=', 21)->where('days', '>', 3);
                                                                        } elseif ($days <= 3) {
                                                                            $values->where('days', '<=', 3);
                                                                        }
                                                                    },
                                                                ])
                                                                ->first();
                                                                $service_fees = $payment_detail->payment ? ($payment_detail->payment->payment_method ? $payment_detail->payment->payment_method->service_fees : 0) : 0;
                                                                $current_price = $payment_detail->final_price - ($payment_detail->final_price * $service_fees / 100);

                                                                $amount = 0;
                                                                if ($cancel_policy) {
                                                                    $amount = $current_price * ($cancel_policy->cancelValue->amount / 100);
                                                                } else {
                                                                    if ($days > 3 && $days < 21)
                                                                        $amount = $current_price * (25 / 100);
                                                                }

                                                                $price = $payment_detail->final_price > 0  &&  $amount < $current_price ? $current_price - $amount : 0;
                                                        }
                                                    }
                                                    $total_refound += $amount;
                                                @endphp
                                                <input type="hidden"
                                                    name="payment_detials[{{ $payment_detail->id }}][course_id]"
                                                    value="{{ $payment_detail->course_id }}">
                                                <div class="col-12 d-flex">
                                                    <div class="form-group col-4">
                                                        <label for="">{{ __('afaq.refound_amount') }}</label>
                                                        <input
                                                            name="payment_detials[{{ $payment_detail->id }}][refound_amount]"
                                                            class="form-control refound_value"
                                                            value="{{ $price }}">
                                                    </div>

                                                    <div class="form-group col-8">
                                                        <label for="">Cancel Reason</label>
                                                        <textarea name="payment_detials[{{ $payment_detail->id }}][cancel_reason]" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                <div class="col-12 d-flex">
                    <div class="form-group col-4">
                        <label for="">{{ __('afaq.refound_method') }}</label>
                        <select name="refound_type" class="form-control" id="">
                            <option value="bank_account">{{ __('afaq.to_bank_account') }}</option>
                            <option value="wallet">{{ __('afaq.wallet') }}</option>
                        </select>
                    </div>
                    {{-- <div class="col-8 d-flex justify-content-end">
                        <span class="h4">{{ __('lms.total') }} : </span>
                        <span class="total_refound h5 text-danger">{{ $total_refound }} {{ __('afaq.SR') }}</span>
                    </div> --}}
                </div>
                <div class="">
                    <button type="submit" class="btn btn-danger"> {{ __('afaq.Save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @parent
    <script>
        var total_refound = 0;
        $('.refound_value').on('change', function() {
            var total_refound = 0;
            $('.refound_value').each(function(index, value) {
                console.log($(value).val());
                total_refound += parseInt($(value).val())
            });
            // $('.total_refound').text(total_refound)
        });
    </script>
@endsection
