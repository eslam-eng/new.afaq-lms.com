@extends('frontend.business.layout.main')
@section('header-scripts')
    <link rel="stylesheet" href="{{ asset('afaq/business/css/account-setting-style.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/business/css/upload-img.style.css') }}">
    <link rel="stylesheet" href="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core.min.css">
    <link rel="stylesheet"
          href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css">

@endsection
@section('content')
    <section class="account-setting-page">
        <div class="account-setting-mainPage ">
            <div class="bunner-acc-setting container">
                <div class="back-bunner">
                        <span style="display: none">
                            <input type="file" id="background" class="input-file-text"/>
                            <i class="fa-regular fa-pen-to-square"></i>
                        </span>
                    <img src="{{asset('afaq/business/imgs/v875-katie-45.png')}}" alt=""/>

                </div>
                <div class="profile-pic">

                    <form id="business_photo" action="{{ url(app()->getLocale() . '/update_personal_photo') }}"
                          enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="input-file">
                            <img id="file_upload" class="upload-img" alt="your image"
                                 src="{{ asset(auth()->user()->personal_photo->url ?? '/default.png') }}">
                            <div class="input-file-upload">
                                <span class="sm-upload-label">{{__('global.edit')}}</span>
                                <input id="personal_photo" type="file"
                                       name="personal_photo"
                                       onchange="readURL(this);"/> {{-- onchange="readURL(this);" --}}

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <div class="acc-setting-tabs container">
                <div class="names-acc-setting">
                    <div class="name-mail">
                        <span>
                            {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? '' }}
                        </span>
                        <em>
                            {{  auth()->user()->email ?? '' }}

                        </em>
                    </div>
                    <div class="tabs-title">
                        <a href="{{ url(app()->getLocale() . '/business-personal-infos') }}">
                            <div class="afaq-acc-name  my-acc">
                                <em class="show"> <img src="{{asset('afaq/business/imgs/fff-1.svg')}}" alt=""> </em>
                                <em class="hide"> <img src="{{asset('afaq/business/imgs/fff.svg')}}" alt=""> </em>
                                <span class="w-15-"></span>
                                <span>{{ __('lms.my_account') }}</span>
                            </div>
                        </a>

                        <a href="{{ url(app()->getLocale() . '/business_packages') }}">
                            <div class="afaq-acc-name Packages">
                                <em class="show"> <img src="{{asset('afaq/business/imgs/apps (-1.svg')}}" alt=""> </em>
                                <em class="hide"> <img src="{{asset('afaq/business/imgs/apps (1).svg')}}" alt=""> </em>
                                <span class="w-15-"></span>
                                <span>{{ __('lms.my_packages') }}</span>
                            </div>
                        </a>


                        <a href="#">
                            <div class="afaq-acc-name active Invoices">
                                <em class="show"> <img src="{{asset('afaq/business/imgs/saxs-1.svg')}}" alt=""> </em>
                                <em class="hide"> <img src="{{asset('afaq/business/imgs/saxs.svg')}}" alt=""> </em>
                                <span class="w-15-"></span>
                                <span>{{ __('lms.my_invoices') }}</span>
                            </div>
                        </a>
                        <a href=" {{ url(app()->getLocale() . '/business_tickets') }}">
                            <div class="afaq-acc-name Tickets">
                                <em class="show"> <img src="{{asset('afaq/business/imgs/Union 87.svg')}}" alt=""> </em>
                                <em class="hide"> <img src="{{asset('afaq/business/imgs/Union 86.svg')}}" alt=""> </em>
                                <span class="w-15-"></span>
                                <span>{{ __('lms.myTicket') }}</span>
                            </div>
                        </a>
                        <div class="afaq-acc-name logout on-logout on-web">

                            <em class="logout"> <img src="{{asset('afaq/business/imgs/exit.svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span id="logou">{{ __('lms.Logout') }}</span>
                            <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="details-acc-setting">
                        <span><i class="fa-solid fa-triangle-exclamation"></i>{{__('afaq.package_expire_at')}}
                            </span>


                    <div class="Invoices-form acc-detials-form show">
                        @foreach($payment_invoices as $pay)
                            <div class="all-invoices">

                                <div class="package-title on-web">
                                    <strong>{{__('afaq.invoice_number')}}</strong>
                                </div>
                                <div class="Invoices-card">
                                    <div class="Invoices-tabels">
                                        <div class="table-details">
                                            <table style="width:100%" class="on-web">
                                                <tr>
                                                    <th>{{__('afaq.invoice_number')}}</th>
                                                    <th>{{__('afaq.total')}}</th>
                                                    <th>{{__('afaq.payment_method')}}</th>
                                                    <th>{{__('global.status')}}</th>
                                                    <th>{{__('afaq.date')}}</th>
                                                </tr>
                                                <tr>
                                                    <td>{{$pay->id ?? ''}}</td>
                                                    <td>{{$pay->price ?? ''}}.{{__('afaq.sar')}} </td>
                                                    <td>{{$pay->provider}}</td>
                                                    <td>
                                                        {{--                                                        {{$pay->status}}--}}
                                                        @if($pay->status == 0)
                                                            {{__('afaq.failed_pay')}}
                                                        @elseif($pay->status == 1)
                                                            {{__('afaq.success_pay')}}
                                                            {{-- {{$pay->status}}   --}}
                                                        @endif
                                                    </td>
                                                    <td>{{date('d-M-Y', strtotime($pay->created_at))}}</td>
                                                </tr>
                                            </table>
                                            <div class="on-mob">
                                                <table style="width:100%">
                                                    <tr>
                                                        <th>{{__('afaq.invoice_number')}}</th>
                                                        <td>{{$pay->id ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{__('afaq.total')}}</th>
                                                        <td>{{$pay->price ?? ''}} SAR</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{__('afaq.payment_method')}}</th>
                                                        <td>{{$pay->provider}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{__('global.status')}}</th>
                                                        {{--                                                    <td>Confirm</td>--}}
                                                        <td>
                                                            @if($pay->status == 0)
                                                                {{__('afaq.failed_pay')}}
                                                            @elseif($pay->status == 1)
                                                                {{__('afaq.success_pay')}}
                                                                {{-- {{$pay->status}}   --}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{__('afaq.date')}}</th>
                                                        {{--                                                    <td>8-AUG-2023</td>--}}
                                                        <td> {{date('d-M-Y', strtotime($pay->created_at))}}</td>


                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="result-invoices">
                                        <span>
                                            {{ app()->getLocale() == 'en' ? $pay->package_name_en ?? '' : $pay->package_name_ar ?? '' }}
                                        </span>
                                            <em>{{$pay->price ?? ''}} {{__('afaq.sar')}}</em>
                                        </div>
                                    </div>
                                    {{--                                <div class="Invoices-btns-active">--}}
                                    {{--                                    <button class="confirm-pay">confirm pay</button>--}}
                                    {{--                                    <button class="changes-pay">changes payment</button>--}}
                                    {{--                                    <button class="cnacel-pay-btn">Cancel</button>--}}
                                    {{--                                </div>--}}
                                    @if($pay->status == 1)

                                        <div class="Invoices-btns-active">
                                            <a href="{{ route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $pay->id]) }}">

                                                <button class="confirm-pay">{{__('afaq.print_invoice')}}</button>
                                            </a>
                                        </div>
                                    @endif
                                    @if($pay->status == 1)
                                        <div class="print-invoice-mob">
                                            <div class="print-invoice">
                                                <a href="{{ route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $pay->id]) }}">

                                                    <span>{{__('afaq.print_invoice')}}</span>

                                                </a>
                                            </div>
                                            @endif
                                            {{--                                    <div class="get-Invoices">--}}
                                            {{--                                        <button class="confirm-pay">confirm pay</button>--}}
                                            {{--                                        <button class="changes-pay">changes payment</button>--}}
                                            {{--                                        <button class="cnacel-pay-btn">Cancel</button>--}}
                                            {{--                                    </div>--}}
                                        </div>
                                </div>


                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core-init.js">
    </script>
    <script>
        $(document).ready(function () {
            $('#logou').click(function () {
                $("#logoutform").submit();
            });
        })
    </script>
    <script>
        $(document).on('click', '.create-ticket-comment', function () {
            var id = $(this).attr('data-ticket-id');
            var url = "{{ route('admin.tickets.storeBusinessComment', 'id:id') }}";
            url = url.replace('id:id', id);
            $('.creat-reblay-popup').attr('action', url);
            $("input[name='ticket_id']").val(id);

        })

    </script>
    <script>
        $(document).ready(function (e) {

            $('#personal_photo').change(function () {
                var formData = new FormData();
                var files = $('#personal_photo')[0].files;
                formData.append('personal_photo', files[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('update_personal_photo')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response);
                        $('#personal_img').attr('src', response);

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
