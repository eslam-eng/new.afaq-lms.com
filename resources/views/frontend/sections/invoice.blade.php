<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('frontend/css/invoice.css ') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>invoice ready for print</title>
</head>

<body>
    <div class="pdf-container">

        <div class="header-content d-flex flex-row">
            <div class="barcode-image">
                {!! $payment->qr_image !!}
            </div>
            <div class="invoice-title d-flex flex-column">
                <h1>فاتورة</h1>
                <h1>Invoice</h1>
            </div>
            <img class="logo-for-print" src="{{ asset('nazil/imgs/logo_for_print.png') }}" alt="">
        </div>
        <div class="invoice-info d-flex flex-row">
            <div class="en-list d-flex flex-row">
                <ul class="title-list">
                    <li>Invoice date</li>
                    <li>Invoice number</li>
                    <li>Tax registration number</li>
                    <li>By</li>
                </ul>
                <div class="wid-20"></div>
                <ul class="content-list">
                    <li>{{ date('d/m/Y', strtotime($payment->created_at)) }}</li>
                    <li>{{ $payment->id ?? $payment->transaction }}</li>
                    <li>310125840600003</li>
                    <li>Nazil alwatania Est. for Trading</li>
                </ul>
            </div>
            <div class="ar-list d-flex flex-row-reverse">
                <ul class="title-list">
                    <li>تاريخ الفاتورة</li>
                    <li>رقم الفاتورة</li>
                    <li>رقم السجل الضريبي</li>
                    <li>بواسطة</li>
                </ul>
                <div class="wid-20"></div>
                <ul class="content-list">
                    <li>{{ date('d/m/Y', strtotime($payment->created_at)) }}</li>
                    <li>{{ $payment->id ?? $payment->transaction }}</li>
                    <li>310125840600003</li>
                    <li>نزيل الوطنية</li>
                </ul>
            </div>
        </div>
        <div class="directed-to d-flex flex-row">
            <h2>Directed To</h2>
            <h2>موجه إلى</h2>
        </div>
        <div class="student-info d-flex flex-row">
            <div class="en-list d-flex flex-row">
                <ul class="title-list">
                    <li>Name</li>
                    <li>Email</li>
                    <li>Phone</li>
                    <li>Specialization</li>
                    <li>Subspecialty</li>
                    <li>SNA Membership No.</li>
                </ul>
                <div class="wid-20"></div>
                <ul class="content-list">
                    <li>{{ $payment->user->full_name_en ?? '' }}</li>
                    <li>{{ $payment->user->email ?? '' }}</li>
                    <li>{{ $payment->user->phone ?? '' }}</li>
                    <li>{{ $payment->user->specialty ? $payment->user->specialty->name_en : '' }}</li>
                    <li>{{ $payment->user->SubSpecialty ? $payment->user->SubSpecialty->name_en : '' }}</li>
                    <li>{{ count($payment->user->memberships)? $payment->user->memberships()->latest()->first()->accreditation_number: '' }}
                    </li>
                </ul>
            </div>
            <div class="ar-list d-flex flex-row-reverse">
                <ul class="title-list">
                    <li>الاسم</li>
                    <li>الإيميل</li>
                    <li>هاتف</li>
                    <li>التخصص</li>
                    <li>التخصص الفرعي</li>
                    <li> SNA رقم عضوية الـ</li>
                </ul>
                <div class="wid-20"></div>
                <ul class="content-list">
                    <li>{{ $payment->user->full_name_ar }}</li>
                    <li>{{ $payment->user->email }}</li>
                    <li>{{ $payment->user->phone }}</li>
                    <li>{{ $payment->user->specialty ? $payment->user->specialty->name_ar : '' }}</li>
                    <li>{{ $payment->user->SubSpecialty ? $payment->user->SubSpecialty->name_ar : '' }}</li>
                    <li>{{ count($payment->user->memberships)? $payment->user->memberships()->latest()->first()->accreditation_number: '' }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-area d-flex flex-row">
            <!-- note: the following table gets data from invoice.js -->
            <table class="table table-left table-dark" id="enTable">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>#</p>
                        </th>
                        <th scope="col">
                            <p>Description</p>
                        </th>
                        <th scope="col">
                            <p>Price</p>
                        </th>
                        <th scope="col">
                            <p>Discount</p>
                        </th>
                        <th scope="col">
                            <p>Price After Discount</p>
                        </th>
                        <th scope="col">
                            <p>No.</p>
                        </th>
                        <th scope="col">
                            <p>Total</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($payment->payment_details)
                        @foreach ($payment->payment_details as $payment_detail)
                            <tr>
                                <td>{{ $payment_detail->id }}</td>
                                <td>{{ $payment_detail->course_name_en ?? '' }}</td>
                                <td>{{ $payment_detail->price ?? '' }}</td>
                                <td>{{ $payment_detail->offer ?? '' }}</td>
                                <td>{{ $payment_detail->final_price }}</td>
                                <td>1</td>
                                <td>{{ $payment_detail->final_price }}</td>
                            </tr>
                        @endforeach
                    @endif

                    @if ($payment->payment_exam_details)
                        @foreach ($payment->payment_exam_details as $payment_detail)
                            <tr>
                                <td>{{ $payment_detail->id }}</td>
                                <td>{{ $payment_detail->exam_name_en ?? '' }}</td>
                                <td>{{ $payment_detail->price ?? '' }}</td>
                                <td>{{ $payment_detail->offer ?? '' }}</td>
                                <td>{{ $payment_detail->final_price }}</td>
                                <td>1</td>
                                <td>{{ $payment_detail->final_price }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <P>TOTAL</P>
                        </td>
                        @if (count($payment->payment_details))
                            <td>
                                <P>{{ $payment->payment_details()->sum('final_price') }} SAR</P>
                            </td>
                        @endif

                        @if (count($payment->payment_exam_details))
                            <td>
                                <P>{{ $payment->payment_exam_details()->sum('final_price') }} SAR</P>
                            </td>
                        @endif

                    </tr>
                </tfoot>
            </table>
            <!-- note: the following table gets data from invoice.js -->
            <table class="table table-right table-dark" id="arTable">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>#</p>
                        </th>
                        <th scope="col">
                            <p>الوصف</p>
                        </th>
                        <th scope="col">
                            <p>السعر</p>
                        </th>
                        <th scope="col">
                            <p> الخصم</p>
                        </th>
                        <th scope="col">
                            <p>السعر بعد الخصم</p>
                        </th>
                        <th scope="col">
                            <p>عدد</p>
                        </th>
                        <th scope="col">
                            <p>الإجمالي</p>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @if ($payment->payment_details)
                        @foreach ($payment->payment_details as $payment_detail)
                            <tr>
                                <td>{{ $payment_detail->id }}</td>
                                <td>{{ $payment_detail->course_name_ar ?? '' }}</td>
                                <td>{{ $payment_detail->price ?? '' }}</td>
                                <td>{{ $payment_detail->offer ?? '' }}</td>
                                <td>{{ $payment_detail->final_price }}</td>
                                <td>1</td>
                                <td>{{ $payment_detail->final_price }}</td>
                            </tr>
                        @endforeach
                    @endif

                    @if ($payment->payment_exam_details)
                        @foreach ($payment->payment_exam_details as $payment_detail)
                            <tr>
                                <td>{{ $payment_detail->id }}</td>
                                <td>{{ $payment_detail->exam_name_ar ?? '' }}</td>
                                <td>{{ $payment_detail->price ?? '' }}</td>
                                <td>{{ $payment_detail->offer ?? '' }}</td>
                                <td>{{ $payment_detail->final_price }}</td>
                                <td>1</td>
                                <td>{{ $payment_detail->final_price }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <P>الإجمــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــالي
                            </P>
                        </td>
                        @if (count($payment->payment_details))
                            <td>
                                <P>{{ $payment->payment_details()->sum('final_price') }} SAR</P>
                            </td>
                        @endif

                        @if (count($payment->payment_exam_details))
                            <td>
                                <P>{{ $payment->payment_exam_details()->sum('final_price') }} SAR</P>
                            </td>
                        @endif

                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="last-section d-flex flex-column">
            <div class="payment-method d-flex flex-row">
                <div class="left d-flex flex-row">
                    <p>Payment Method</p>
                    @if ($payment->provider == 'Free' && $payment->wallet)
                        <p>Wallet</p>
                    @else
                        <p>{{ $payment->provider == 'Bank' ? 'Bank Transfer' : $payment->provider }}</p>
                    @endif
                </div>
                <div class="right d-flex flex-row">
                    @if ($payment->provider == 'Free' && $payment->wallet)
                        المحفظة
                    @else
                        <p>{{ $payment->provider == 'Bank' ? 'تحويل بنكى' : $payment->provider }}</p>
                    @endif
                    <p>وسيلة الدفع</p>
                </div>
            </div>
            <div class="total-table d-flex flex-row">
                <table class="table-left">
                    @php
                        $price = $payment->amount + $payment->wallet_discount;
                        $total_without_tax = (float) ($payment->amount + $payment->wallet_discount / (1 + 0.15));
                    @endphp
                    <tr>
                        <th>Total</th>
                        <td>{{ number_format((float) $total_without_tax, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Value Added Tax 15%</th>
                        <td>{{ number_format((float) ((float) $price - $total_without_tax), 2, '.', '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Final Total</th>
                        <td>{{ $price }} SAR</td>
                    </tr>
                </table>
                <table class="table-right">
                    <tr>
                        <th>المجموع</th>
                        <td>{{ number_format((float) $total_without_tax, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <th>الخصم</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>ضريبة القيمة المضافة %15</th>
                        <td>{{ number_format((float) ((float) $price - $total_without_tax), 2, '.', '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>المجموع النهائي</th>
                        <td>{{ $price }} SAR</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <script src="{{ asset('frontend/js/invoice.js') }}"></script>
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>
    <script>
        setTimeout(function() {
            window.print()
        }, 3000)
    </script>
</body>

</html>
