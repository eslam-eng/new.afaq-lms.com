@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderPayments">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.user_name') }}

                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.final_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.coupon_text') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.coupon_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.coursesUser.fields.payment_method') }}
                            </th>
                            {{-- <th>
                                {{ trans('cruds.coursesUser.fields.bank_id') }}
                            </th> --}}
                            <th>
                                {{ trans('cruds.coursesUser.fields.bank_name') }}
                            </th>

                            <th>
                                {{ trans('cruds.coursesUser.fields.bank_number') }}
                            </th>

                            <th>
                                {{ trans('cruds.coursesUser.fields.join_date') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($courses)
                            @foreach ($courses as $course)
                                <tr data-entry-id="{{ $course->course_id }}">
                                    <td></td>
                                    <td>
                                        {{ $course->id ?? '' }}
                                    </td>

                                    <td>
                                        {{ app()->getLocale() == 'en' ? $course->user->full_name_en ?? '' : $course->user->full_name_ar ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course->user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course->course_price ?? '' }}
                                    </td>

                                    <td>
                                        {{ $course->final_total  ? ($course->final_total + $course->payment->wallet_discount) : '' }}
                                    </td>

                                    <td>
                                        {{ $course->coupon_amount ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course->coupon_type ?? '' }}
                                    </td>

                                    <td>
                                        @if($course->payment->wallet && $course->payment_provider == 'Free')
                                            {{ __('lms.wallet') }}
                                        @else
                                            {{ $course->payment_provider ?? '' }}
                                        @endif
                                    </td>
                                    {{-- <td>
                                        {{ $course->bank_invoice->id ?? '' }}
                                    </td> --}}
                                    <td>
                                        {{ $course->bank_invoice->bank_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course->bank_invoice->bank_number ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course->created_at ?? '' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
