@extends('layouts.front ')
@section('content')

    <section class=" payment-page payment-page-details-lms  ">
        <div class="idu-programss my-invoice-page">
            <div class="courses_filters-nd payment-card">
                <div class="reservedcourse">
                    <h3> سيتم حذف الطلب إذا لم يتم تأكيد الدفع خلال 48 ساعة</h3>
                    <div class="d-flex justify-content-center my-3">
                        <a class="btn btn-success text-light"
                            href="{{ url(app()->getLocale() . '/my_invoices') }}">فواتيري</a>
                    </div>
                </div>
                <div>
                    <p>رقم الحساب الجاري: {{ config('app.bank_account_number', '5048833559940') }}</p>

                    <p>رقم الحساب الموحد IBAN: {{ config('app.bank_iban_number', 'SA7920000005048833559940') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
