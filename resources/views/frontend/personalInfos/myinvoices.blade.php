@extends('frontend.personalInfos.index')

@section('myprofile')
    <style>
        @media screen and (max-widspan: 830px) {
            .precemp {
                bottom: 30px;
            }
        }
    </style>
    <section class="mycourse-page-lms">
        <div class="container sit-container">
            <div class="all-courses">
                <div class="myprofile-page">

                    @if (session('enroll'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('enroll') }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="mycourse-page d-flex justify-content-between">
                        <div class=" myprofile-title">
                            <h3> {{ __('lms.my_invoices') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="mycourse-page-filtter">
                    {{-- @if (count($courses) > 0)
                    <span>{{__('lms.sort')}}</span>
                <div class="lms-filtter-stm">
                    <select name="sort" id="sort" class="no-search select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="">{{__('lms.select')}}</option>
                        <option value="date_high" {{ request('sort') == 'date_high' ? 'selected' : ''}}>{{__('lms.release_new')}}</option>
                        <option value="date_low" {{ request('sort') == 'date_low' ? 'selected' : ''}}>{{__('lms.release_old')}}</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : ''}}>{{__('lms.price_high')}}</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : ''}}>{{__('lms.price_low')}}</option>
                    </select>
                </div>
                @endif --}}
                    <!-- *************************************************************** -->
                    @if (count($payments) > 0)
                        <div class="Other_courses_lms invoice_grid_area">
                            @foreach ($payments as $payment)
                                <div class="invoice_my_profile">
                                    <div class="invoice_content">
                                        <div class="invoice_head">
                                            <span>{{ __('lms.invoice_number') }}</span>
                                            <span class="">{{ __('lms.total') }}</span>
                                            <span>{{ __('lms.payment_method') }}</span>
                                            <span>{{ __('global.status') }}</span>
                                            <span>{{ __('lms.date') }}</span>

                                        </div>
                                        <div>
                                            <span scope="row">{{ $payment->payment_number }}</span>

                                            @if ($payment->provider == 'Free' && $payment->wallet)
                                                <span class="mx-4" style="font-weight: bold;">
                                                    {{ $payment->wallet_discount . ' ' . __('lms.currency') }}</span>
                                                <span>{{ __('lms.wallet') }}</span>
                                            @else
                                                <span class="mx-4" style="font-weight: bold;">
                                                    {{ isset($payment->amount) ? $payment->amount + $payment->wallet_discount . ' ' . __('lms.currency') : '' }}</span>
                                                <span>{{ $payment->provider }}</span>
                                            @endif
                                            <span>{{ $payment->status && $payment->approved ? __('lms.invoice_approved') : __('lms.invoice_wait_approveal') }}
                                            </span>
                                            <span>{{ date('Y-m-d h:i A', strtotime($payment->created_at ?? '')) }}</span>
                                        </div>
                                        <span class="collapse_title" onclick="collapseTitleInvoice(this)">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </span>

                                        @if ($payment->payment_details)
                                            @foreach ($payment->payment_details as $p)
                                                <div class="invoice_title_and_price">
                                                    <span>{{ app()->getLocale() == 'en' ? $p->course_name_en : $p->course_name_ar }}</span>
                                                    <span>{{ isset($p->final_price) ? $p->final_price . ' ' . __('lms.currency') : '' }}</span>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if ($payment->payment_exam_details)
                                            @foreach ($payment->payment_exam_details as $e)
                                                <div class="invoice_title_and_price">
                                                    <span>{{ app()->getLocale() == 'en' ? $e->exam_name_en : $e->exam_name_ar }}</span>
                                                    <span>{{ isset($e->final_price) ? $e->final_price . ' ' . __('lms.currency') : '' }}</span>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="invoice_actions">
                                        @if (!$payment->status)
                                            @if (!$payment->status_response)
                                                <form class="invoice_web_button"
                                                    action="{{ url('/') . '/' . app()->getLocale() . '/checkout/banktransfer/confirm' }}">
                                                    @if ($payment->payment_exam_details->count() > 0)
                                                        <input type="hidden" name="exam_id"
                                                            value="{{ $payment->payment_exam_details->first()->exam_id }}">
                                                    @endif
                                                    <input type="hidden" name="invoice_id"
                                                        value="{{ $payment->transaction }}">
                                                    <button type="submit" class="button_confirm_payment">
                                                        {{ __('lms.confirm_payment') }}</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.carts.payment_methods', ['locale' => app()->getLocale(), 'payment_id' => $payment->payment_number]) }}"
                                                class="print_invoice_button text-center">{{ __('home.change_payment_method') }}</a>
                                            {{--                                <a href="{{ route('admin.cancel-payments.store',['locale' => app()->getLocale(),'payment_id' => $payment->payment_number]) }}" class="print_invoice_button text-center">{{ __('lms.cancel') }}</a> --}}
                                        @elseif($payment->status && !$payment->approved)
                                            <form
                                                action="{{ route('admin.reservations.cancel_payment_front', ['locale' => app()->getLocale(), 'payment_id' => $payment->id]) }}"
                                                method="POST">
                                                {{--                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                                <input type="hidden" name="invoice_id"
                                                    value="{{ $payment->transaction }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <button type="submit" class="button_confirm_payment">
                                                    {{ __('lms.cancel') }}</button>
                                            </form>
                                        @else
                                            <a href="{{ route('invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $payment->id]) }}"
                                                class="print_invoice_button text-center">
                                                {{ __('lms.print_invoice') }}</a>
                                        @endif

                                        {{-- <button class="invoice_cancel_button">{{__('global.cancel')}}</button> --}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('frontend/js/collapse_invoice_title.js') }}"></script>
@endsection
