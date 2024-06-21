@extends('layouts.front ')
@section('content')

    <section class=" payment-page payment-page-details-lms   container">
        <div class="idu-programss my-invoice-page">
            <div class="courses_filters-nd payment-card">
                <div class="reservedcourse">
                    <h3>  {{__('global.cancel_by_24')}}</h3>
                    <div class="d-flex justify-content-center my-3">
                        <a class="btn btn-success text-light"
                            href="{{ url(app()->getLocale() . '/my_invoices') }}"> {{__('global.my_invoices')}}</a>
                    </div>
                </div>
                <div>
                    <p> <i class="fa-solid fa-file-invoice"></i>{{__('global.company_name')}}:{{__('global.Company_name')}} </p>
                    <p><i class="fa-solid fa-file-invoice"></i> {{__('global.current_account_number')}}: {{ config('app.bank_account_number', '5048833559940') }}</p>

                    <p><i class="fa-solid fa-file-invoice"></i>{{__('global.unified_account_number')}}: {{ config('app.bank_iban_number', 'SA7920000005048833559940') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
