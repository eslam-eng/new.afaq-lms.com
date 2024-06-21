@extends('layouts.front')
@section('content')
    <style>
        .innerheader-nd {
            height: 45vh;
        }

        @media screen and (max-width: 1200px) {
            .innerheader-nd {
                height: 95vh;
            }

            .precemp {
                right: 60px;
            }

            .ltr .precemp {
                left: 60px;
            }
        }

        @media (min-width: 601px) and (max-width: 821px) {
            .innerheader-nd {
                height: 65vh;
            }
        }

        @media screen and (max-width: 830px) {
            .precemp {
                bottom: 30px;
            }
        }
    </style>
    <section class="payment-page">
        <div class="idu-programss">
            <div class="courses_filters-nd payment-card">
                <h2> {{ __('lms.Addpaymentinformation') }}</h2>
                <form action="{{ url('/' . app()->getLocale() . '/checkout/banktransfer/confirm') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice_id }}" id="invoice_id">
                    @if (request('exam_id'))
                        <input type="hidden" name="exam_id" value="{{ request('exam_id') }}" id="exam_id">
                    @endif
                    <div class="payment-way d-flex align-items-center mt-2 mb-2">
                        <div class="payment-box">
                            <label for=""> {{ __('lms.paymentmethod') }}</label>
                            <select name="payment_method_id" value="{{ old('payment_method_id') }}" required
                                class="form-control" id="bank" disabled>
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}"
                                        {{ $payment_method->id == $payment->payment_method_id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'en' ? $payment_method->name_en : $payment_method->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="payment_method_id" value="{{ $payment->payment_method_id }}">
                            @if ($errors->has('payment_method_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_method_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="payment-box">
                            <label for=""> {{ __('lms.theamount') }}</label>
                            <input type="text" name="amount" value="{{ $payment->amount }}" required
                                placeholder="the amount" readonly>
                            @if ($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>
                        <div class="payment-box">
                            <label for="">{{ __('lms.thecurrency') }} </label>
                            <select name="currency" value="{{ old('currency') }}" required class="form-control"
                                id="currency" disabled>
                                <option value="SAR">{{ app()->getLocale() == 'en' ? 'SAR' : 'ر.س' }}</option>
                            </select>
                            <input type="hidden" name="currency" value="SAR">

                            @if ($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="payment-way d-flex align-items-center mt-2 mb-2">
                        <div class="payment-box lms-paymet-details">
                            <label for=""> {{ __('lms.paymetdate') }}</label>
                            <input type="date" name="date" value="{{ old('date') }}" required placeholder="date">
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        <div class="payment-box lms-paymet-details">
                            <label for=""> {{ __('lms.banktransfer') }}</label>
                            <select name="bank_id" value="{{ old('bank_id') }}" required class="form-control"
                                id="bank_id">
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">
                                        {{ app()->getLocale() == 'en' ? $bank->name_en : $bank->name_ar }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('bank_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="payment-way d-flex align-items-center mt-2 mb-2">
                        <div class="payment-box lms-paymet-details">
                            <label for=""> {{ __('lms.accountname') }}</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" required placeholder="">
                            @if ($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="payment-box lms-paymet-details">
                            <label for=""> {{ __('lms.accountnumber') }}</label>
                            <input type="number" name="bank_number" value="{{ old('bank_number') }}" required>
                            @if ($errors->has('bank_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_number') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="upload-img mt-2 mb-2">
                        <input type="file" name="invoice_image" required id="myFile">
                        @if ($errors->has('invoice_image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('invoice_image') }}
                            </div>
                        @endif
                    </div>

                    <!-- <div class="payment-all-details">
                        <strong>{{ __('lms.Unpaidbills') }} <span>5631 SAR</span></strong>
                        <div class="payment-way d-flex align-items-center mt-2 mb-2">
                            <div class="payment-result">
                                <label for=""> {{ __('lms.inclusion') }}</label>
                                <span class="put-details-result"> frghh</span>
                            </div>
                            <div class="payment-result">
                                <label for=""> {{ __('lms.paymetdate') }}</label>
                                <span class="put-details-result"> frghh</span>
                            </div>
                            <div class="payment-result">
                                <label for="">{{ __('lms.thetotal') }} </label>
                                <span class="put-details-result"> frghh</span>
                            </div>
                            <div class="payment-result">
                                <label for="">{{ __('lms.thedetails') }} </label>
                                <span class="put-details-result"> frghh</span>
                            </div>
                        </div>
                    </div> -->

                    <div class="submit-btn d-flex align-items-center">
                        <button class="Paymentconfirmation" type="submit">{{ __('lms.Paymentconfirmation') }}</button>
                        <span style="width:20px;"></span>
                        <button class="Paymentcancel" type="reset">{{ __('lms.cancel') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
