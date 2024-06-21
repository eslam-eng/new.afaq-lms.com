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
                    <img  src="{{asset('afaq/business/imgs/v875-katie-45.png')}}" alt=""/>

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
                                       onchange="readURL(this);"  /> {{-- onchange="readURL(this);" --}}

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
                        <a href="#">
                        <div class="afaq-acc-name active my-acc">
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




                        <a href="  {{ url(app()->getLocale() . '/business_invoices') }}">
                        <div class="afaq-acc-name Invoices">
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
                        <div class="afaq-acc-name logout on-logout on-web"  >

                            <em class="logout" > <img src="{{asset('afaq/business/imgs/exit.svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span id="logou" >{{ __('lms.Logout') }}</span>
                            <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>


                    <div class="details-acc-setting">
                        <span><i class="fa-solid fa-triangle-exclamation"></i>
                            {{__('afaq.package_expire_at')}}
                        </span>
                        <!-- Section of Account Setting -->
                        <div class="my-acc-form show acc-detials-form">
                            <form method="post" action="{{ url(app()->getLocale() . '/edit_myprofile') }}" id="infoForm"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="business" id="business" value="2">
                            <div class="form-detials">
                                <div class="form-g">
                                    <label for="full_name_ar">{{ trans('frontend.register.Full Name Arabic') }} <span
                                        >*</span></label>
                                    <input disabled
                                           type="text" name="full_name_ar" id="full_name_ar" minlength="3"
                                           maxlength="50"
                                           value="{{ old('full_name_ar', $data->full_name_ar) }}"
                                           placeholder="{{ trans('frontend.register.Full Name Arabic') }}" required>

                                </div>
                                <div class="form-g">
                                    <label for="full_name_en">{{ trans('frontend.register.Full Name English') }} <span
                                            class="text-danger">*</span></label>
                                    <input disabled
                                           class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}"
                                           type="text" name="full_name_en" id="full_name_en" minlength="3"
                                           maxlength="50" value="{{ old('full_name_en', $data->full_name_en) }}"
                                           required
                                           placeholder="{{ trans('frontend.register.Full Name English') }}">
                                </div>

                                <div class="form-g">
                                    <label class="required" for="name_title">{{ trans('frontend.register.Title') }}
                                        <span
                                        >*</span></label>
                                    <select name="name_title" required>

                                        <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                        <option
                                            value="Mr." {{ old('name_title' , $data->name_title) == 'Mr.' ? 'selected' : '' }}>
                                            Mr.
                                        </option>
                                        <option
                                            value="Ms." {{ old('name_title', $data->name_title) == 'Ms.' ? 'selected' : '' }}>
                                            Ms.
                                        </option>
                                        <option
                                            value="Dr." {{ old('name_title', $data->name_title) == 'Dr.' ? 'selected' : '' }}>
                                            Dr.
                                        </option>
                                        <option value="Prof."
                                            {{ old('name_title', $data->name_title) == 'Prof.' ? 'selected' : '' }}>
                                            Prof.
                                        </option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="form-g">
                                    <label class="required" for="gender">{{ trans('frontend.register.gender') }} <span
                                        >*</span></label>
                                    <select
                                        class="form-control col-auto d-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                        id="gender" name="gender" required>
                                        <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                        <option
                                            value="male" {{ old('gender', $data->gender) == 'male' ? 'selected' : $data->gender}}>{{app()->getLocale()=='ar'?'ذكر':'Male'}} </option>
                                        <option
                                            value="female" {{ old('gender', $data->gender) == 'female' ? 'selected' : $data->gender}}>{{app()->getLocale()=='ar'?'أنثي':'Female'}}</option>

                                    </select>
                                    <i class="fa-solid fa-chevron-down"></i>
                                    @if ($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                </div>
                                {{--                            {{dd($data->toArray())}}--}}
                                <div class="form-g">
                                    <label
                                        for="phone">{{ trans('frontend.register.Phone Number') }} <span
                                        >*</span></label>
                                    <input
                                        type="tel" name="phone" id="phone" maxlength="14" aria-valuemax="14"
                                        value="{{ old('phone',  $data->phone) }}" required>
                                </div>
                                <div class="form-g">
                                    <label for="name">{{ trans('frontend.register.Email') }}
                                        <span class="text-danger">*</span></label>
                                    <input disabled type="email" name="email"
                                           required
                                           placeholder="{{ trans('frontend.register.Email') }}"
                                           value="{{ old('email', $data->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="afaq-acc-name save-btn on-web">
                                <button>{{__('afaq.Save')}}</button>
                            </div>
                            <div class="afaq-acc-name logout on-mob">
                                <span>{{__('afaq.Save')}}</span>
                            </div>
                            </form>
                        </div>
                        <!-- End Account Setting -->
                    <!-- Section Of Packages -->

{{--                        <div class="Packages-form acc-detials-form">--}}
{{--                            @foreach($package_payment as $pack_pay)--}}
{{--                            <div class="package-title on-web">--}}
{{--                                <strong>--}}
{{--                                    {{ app()->getLocale() == 'en' ? $pack_pay->package_name_en ?? '' : $pack_pay->package_name_ar ?? '' }}--}}

{{--                                </strong>--}}
{{--                            </div>--}}
{{--                            <div class="packages-card">--}}
{{--                                <div class="all-evnts pack-evnts">--}}
{{--                                    <div class="img-evnt">--}}
{{--                                        <div class="img-ev-logo">--}}
{{--                                            <img src="{{asset('afaq/business/imgs/Layer 18.svg')}}" alt="">--}}
{{--                                        </div>--}}
{{--                                        <span>{{__('afaq.All_Events')}}</span>--}}
{{--                                    </div>--}}
{{--                                    <em>{{$pack_pay->event_number ?? ''}}</em>--}}
{{--                                </div>--}}
{{--                                <div class="used-events pack-evnts">--}}
{{--                                    <div class="img-evnt">--}}
{{--                                        <div class="img-ev-logo">--}}
{{--                                            <img src="{{asset('afaq/business/imgs/speedometer_4399711.svg')}}" alt="">--}}
{{--                                        </div>--}}
{{--                                        <span>{{__('afaq.Used_Events')}}</span>--}}
{{--                                    </div>--}}
{{--                                    <em>0</em>--}}
{{--                                </div>--}}
{{--                                <div class="your-balance pack-evnts">--}}
{{--                                    <div class="img-evnt">--}}
{{--                                        <div class="img-ev-logo">--}}
{{--                                            <img src="{{asset('afaq/business/imgs/wallet_483742.svg')}}" alt="">--}}
{{--                                        </div>--}}
{{--                                        <span>{{__('lms.my_balance')}}</span>--}}
{{--                                    </div>--}}
{{--                                    <em>0 <small>SAR</small></em>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

{{--                        <!-- End Package Section -->--}}


{{--                        <!-- Start of Invoices Section -->--}}

{{--                        <div class="Invoices-form acc-detials-form">--}}
{{--                            @foreach($payment_invoices as $pay)--}}

{{--                            <div class="package-title on-web">--}}
{{--                                <strong>{{__('afaq.invoice_number')}}</strong>--}}
{{--                            </div>--}}
{{--                            <div class="Invoices-card">--}}
{{--                                <div class="Invoices-tabels">--}}
{{--                                    <div class="table-details">--}}
{{--                                        <table style="width:100%" class="on-web">--}}
{{--                                            <tr>--}}
{{--                                                <th>{{__('afaq.invoice_number')}}</th>--}}
{{--                                                <th>{{__('afaq.total')}}</th>--}}
{{--                                                <th>{{__('afaq.payment_method')}}</th>--}}
{{--                                                <th>{{__('global.status')}}</th>--}}
{{--                                                <th>{{__('afaq.date')}}</th>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$pay->id ?? ''}}</td>--}}
{{--                                                <td>{{$pay->price ?? ''}}.{{__('afaq.sar')}} </td>--}}
{{--                                                <td>{{$pay->provider}}</td>--}}
{{--                                                <td>{{$pay->status}}</td>--}}
{{--                                                <td>{{date('d-M-Y', strtotime($pay->created_at))}}</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                        <div class="on-mob">--}}
{{--                                            <table style="width:100%">--}}
{{--                                                <tr>--}}
{{--                                                    <th>{{__('afaq.invoice_number')}}</th>--}}
{{--                                                    <td>{{$pay->id ?? ''}}</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>{{__('afaq.total')}}</th>--}}
{{--                                                    <td>{{$pay->price ?? ''}} SAR</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>{{__('afaq.payment_method')}}</th>--}}
{{--                                                    <td>{{$pay->provider}}</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>{{__('global.status')}}</th>--}}
{{--                                                    <td>Confirm</td>--}}
{{--                                                    <td>{{$pay->status}}</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>{{__('afaq.date')}}</th>--}}
{{--                                                    <td>8-AUG-2023</td>--}}
{{--                                                     <td> {{date('d-M-Y', strtotime($pay->created_at))}}</td>--}}




{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="result-invoices">--}}
{{--                                        <span>--}}
{{--                                            {{ app()->getLocale() == 'en' ? $pay->package_name_en ?? '' : $pay->package_name_ar ?? '' }}--}}
{{--                                        </span>--}}
{{--                                        <em>{{$pay->price ?? ''}} {{__('afaq.sar')}}</em>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="Invoices-btns-active">--}}
{{--                                    <button class="confirm-pay">confirm pay</button>--}}
{{--                                    <button class="changes-pay">changes payment</button>--}}
{{--                                    <button class="cnacel-pay-btn">Cancel</button>--}}
{{--                                </div>--}}
{{--                                @if($pay->status == 1)--}}

{{--                                <div class="Invoices-btns-active">--}}
{{--                                    <a href="{{ route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $pay->id]) }}">--}}

{{--                                    <button class="confirm-pay">{{__('afaq.print_invoice')}}</button>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                                @if($pay->status == 1)--}}
{{--                                <div class="print-invoice-mob">--}}
{{--                                    <div class="print-invoice">--}}
{{--                                    <a href="{{ route('business_invoice.print', ['locale' => app()->getLocale(), 'payment_id' => $pay->id]) }}">--}}

{{--                                        <span>{{__('afaq.print_invoice')}}</span>--}}

{{--                                    </a>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="get-Invoices">--}}
{{--                                        <button class="confirm-pay">confirm pay</button>--}}
{{--                                        <button class="changes-pay">changes payment</button>--}}
{{--                                        <button class="cnacel-pay-btn">Cancel</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="Invoices-card">--}}
{{--                                <div class="Invoices-tabels">--}}
{{--                                    <div class="table-details">--}}
{{--                                        <table style="width:100%" class="on-web">--}}
{{--                                            <tr>--}}
{{--                                                <th>Invoice nu.</th>--}}
{{--                                                <th>Total</th>--}}
{{--                                                <th>Pay method</th>--}}
{{--                                                <th>Statuse</th>--}}
{{--                                                <th>Date</th>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>112</td>--}}
{{--                                                <td>229 SAR</td>--}}
{{--                                                <td>Bank</td>--}}
{{--                                                <td>Confirm</td>--}}
{{--                                                <td>8-AUG-2023</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                        <div class="on-mob">--}}
{{--                                            <table style="width:100%">--}}
{{--                                                <tr>--}}
{{--                                                    <th>Invoice nu.</th>--}}
{{--                                                    <td>112</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Total</th>--}}
{{--                                                    <td>229 SAR</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Pay method</th>--}}
{{--                                                    <td>Bank</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Statuse</th>--}}
{{--                                                    <td>Confirm</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Date</th>--}}
{{--                                                    <td>8-AUG-2023</td>--}}
{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="result-invoices">--}}
{{--                                        <span>icd 10 australian - upgrading from 6th edition to 10th edition</span>--}}
{{--                                        <em>229 SAR</em>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="Invoices-btns-active">--}}
{{--                                    <button class="confirm-pay">print</button>--}}
{{--                                </div>--}}
{{--                                <div class="print-invoice-mob">--}}
{{--                                    <div class="print-invoice">--}}
{{--                                        <span>PRINT INVOICE</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="get-Invoices">--}}
{{--                                        <button class="confirm-pay">print</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="Invoices-card">--}}
{{--                                <div class="Invoices-tabels">--}}
{{--                                    <div class="table-details">--}}
{{--                                        <table style="width:100%" class="on-web">--}}
{{--                                            <tr>--}}
{{--                                                <th>Invoice nu.</th>--}}
{{--                                                <th>Total</th>--}}
{{--                                                <th>Pay method</th>--}}
{{--                                                <th>Statuse</th>--}}
{{--                                                <th>Date</th>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>112</td>--}}
{{--                                                <td>229 SAR</td>--}}
{{--                                                <td>Bank</td>--}}
{{--                                                <td>Confirm</td>--}}
{{--                                                <td>8-AUG-2023</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                        <div class="on-mob">--}}
{{--                                            <table style="width:100%">--}}
{{--                                                <tr>--}}
{{--                                                    <th>Invoice nu.</th>--}}
{{--                                                    <td>112</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Total</th>--}}
{{--                                                    <td>229 SAR</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Pay method</th>--}}
{{--                                                    <td>Bank</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Statuse</th>--}}
{{--                                                    <td>Confirm</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Date</th>--}}
{{--                                                    <td>8-AUG-2023</td>--}}
{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="result-invoices">--}}
{{--                                        <span>icd 10 australian - upgrading from 6th edition to 10th edition</span>--}}
{{--                                        <em>229 SAR</em>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="Invoices-btns-active">--}}
{{--                                    <button class="cnacel-pay-btn">Cancel</button>--}}
{{--                                </div>--}}
{{--                                <div class="print-invoice-mob">--}}
{{--                                    <div class="print-invoice">--}}
{{--                                        <span>PRINT INVOICE</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="get-Invoices">--}}
{{--                                        <button class="cnacel-pay-btn">Cancel</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                                               <!-- End of Invoices Section -->--}}
{{--                        <!-- Start  all Ticket index Section -->--}}
{{--                        <div class="Tickets-form acc-detials-form">--}}
{{--                            <div class="add-tickets">--}}
{{--                                <span>{{__('lms.my_tickets')}}--}}
{{--                                    <i class="fa-solid fa-plus"></i></span>--}}
{{--                            </div>--}}
{{--                            <div class="table-tickets">--}}
{{--                                <table style="width:100%">--}}
{{--                                    <tr class="head-tick">--}}
{{--                                        <th>{{__('lms.ticket_title')}}</th>--}}
{{--                                        <th>{{__('lms.ticket_status')}}</th>--}}
{{--                                        <th>{{__('lms.ticket_date')}}</th>--}}
{{--                                    </tr>--}}

{{--                                    @foreach($tickets as $ticket)--}}

{{--                                    <tr class="body-tick" id="ha" data-id="{{$ticket->id}}">--}}

{{--                                        <td class="tick-title">{{$ticket->title ?? ''}}</td>--}}
{{--                                        @if($ticket->statues == '1' )--}}
{{--                                            <td class="tick-stuts Solved">{{__('lms.ticket_solved')}}</td>--}}
{{--                                        @elseif($ticket->statues == '0')--}}
{{--                                        <td class="tick-stuts Opened">{{__('lms.ticket_opened')}}</td>--}}
{{--                                        @endif--}}


{{--                                        <td class="tick-date">{{$ticket->created_at}}</td>--}}
{{--                                    </tr>--}}
{{--                                    @endforeach--}}
{{--                                    <tr class="body-tick">--}}
{{--                                        <td class="tick-title">I Have Problem</td>--}}
{{--                                        <td class="tick-stuts Solved">Solved</td>--}}
{{--                                        <td class="tick-date">2023-02-06 15:13:54</td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- ************ creat tickets******************* -->--}}
{{--                            <div class="ticket-creat">--}}
{{--                                <div class="fk-layer-ticket"></div>--}}
{{--                                <div class="creat-ticket-form">--}}
{{--                                    <div class="close-ticket">--}}
{{--                                        <i class="fa-solid fa-circle-xmark"></i>--}}
{{--                                    </div>--}}
{{--                                    <form method="post" action="{{ url(app()->getLocale() . '/create_tickets') }}" enctype="multipart/form-data">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">--}}
{{--                                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">--}}
{{--                                        <input type="hidden" name="type" value="Business">--}}

{{--                                        <div class="ticket-description-title">--}}
{{--                                            <span class="ticket-title">--}}
{{--                                                {{__('lms.ticket')}}--}}
{{--                                            </span>--}}
{{--                                            <div class="upload-ticket-img">--}}
{{--                                                <div class="upload-img-sec">--}}
{{--                                                    <div class="br-upload">--}}
{{--                                                        <label class="upload-label"--}}
{{--                                                               for="multiple-files"><span></span></label>--}}
{{--                                                        <input class="upload-input" id="image" type="file"--}}
{{--                                                               accept=".gif, .jpg, .png" multiple="multiple"--}}
{{--                                                               name="image"/>--}}


{{--                                                        <div class="upload-list"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-base mt-1"></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="sm-form-tik">--}}
{{--                                            <div class="ticket-details">--}}
{{--                                                <div class="sm-label">--}}
{{--                                                    <label for="title">{{__('lms.ticket_title')}}</label>--}}
{{--                                                    <input type="text" name="title" id="title" >--}}
{{--                                                </div>--}}
{{--                                                <div class="sm-label">--}}
{{--                                                    <label for="ticket_category_id">{{__('lms.ticket_category')}}</label>--}}
{{--                                                    <select name="ticket_category_id" id="ticket_category_id" required>--}}
{{--                                                        <option value="" selected disabled></option>--}}
{{--                                                        @foreach ($categories as $category)--}}
{{--                                                            <option value="{{ $category->id }}">--}}
{{--                                                                {{ app()->getLocale() == 'en' ? $category->title_en : $category->title_ar }}--}}
{{--                                                            </option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                                <div class="sm-label sm-textarea ">--}}
{{--                                                    <label for="description">{{__('lms.ticket_description')}} </label>--}}
{{--                                                    <textarea name="description" id="description" cols="10" rows="4"></textarea>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="action-btn">--}}
{{--                                            <button class="Create-last creat-reblay" type="submit"> {{__('lms.ticket_create')}}</button>--}}
{{--                                            <button class="Cancel-last" >{{__('lms.ticket_cancel')}} </button>--}}

{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- **************** end ticket-creat -->--}}
{{--                            <!-- **************** start ticket-opened -->--}}
{{--                            @foreach($tickets as $tick)--}}
{{--                                <div class="ticket-opened ticket-opened-{{$tick->id}}">--}}


{{--                                <div class="fk-layer-ticket"></div>--}}

{{--                                <div class="creat-ticket-form ">--}}
{{--                                    <div class="close-ticket">--}}
{{--                                        <i class="fa-solid fa-circle-xmark"></i>--}}
{{--                                    </div>--}}
{{--                                    <form action="">--}}
{{--                                        <div class="ticket-description-title">--}}
{{--                                            <span class="ticket-title">--}}
{{--                                                Ticket Description--}}
{{--                                            </span>--}}
{{--                                            <div class="upload-ticket-img">--}}
{{--                                                <div class="upload-img-sec">--}}
{{--                                                    <div class="br-upload">--}}
{{--                                                        <label class="upload-label"--}}
{{--                                                               for="multiple-files"><span></span></label>--}}
{{--                                                        <input class="upload-input" id="image" type="file"--}}
{{--                                                               accept=".gif, .jpg, .png" multiple="multiple"--}}
{{--                                                               name="image"/>--}}
{{--                                                        <div class="upload-list"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-base mt-1"></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="problem-dec ">--}}
{{--                                            <div class="sm-problem-details">--}}
{{--                                                <div class="problem-title">--}}
{{--                                                    <strong>{{$tick->title}}</strong>--}}
{{--                                                    <em>{{$tick->created_at}}</em>--}}
{{--                                                </div>--}}
{{--                                                <div class="problem-result">--}}
{{--                                                    @if($tick->statues && $tick->statues != "0")--}}
{{--                                                        <span class="sloved-buge">{{__('lms.ticket_solved')}}</span>--}}
{{--                                                    @else--}}
{{--                                                    <span class="Opened-buge">{{__('lms.ticket_opened')}}</span>--}}

{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="problem-p">--}}
{{--                                                <p>{{$tick->description}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="problem-replies">--}}
{{--                                            <div class="ticket-description-title">--}}
{{--                                                <span class="ticket-title">--}}
{{--                                                    {{__('lms.replies')}}--}}
{{--                                                </span>--}}
{{--                                                <div class="upload-ticket-img">--}}
{{--                                                    <div class="upload-img-sec">--}}
{{--                                                        <div class="br-upload">--}}
{{--                                                            <label class="upload-label"--}}
{{--                                                                   for="multiple-files"><span></span></label>--}}
{{--                                                            <input class="upload-input" id="image" type="file"--}}
{{--                                                                   accept=".gif, .jpg, .png" multiple="multiple"--}}
{{--                                                                   name="image"/>--}}
{{--                                                            <div class="upload-list"></div>--}}
{{--                                                        </div>--}}
{{--                                                        <p class="text-base mt-1"></p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="all-replies-problem">--}}
{{--                                                @forelse ($tick->ticket_comments as $comment)--}}
{{--                                                <div class="problem-card">--}}

{{--                                                    <div class="sm-replies-all">--}}
{{--                                                        <div class="ticket-img">--}}
{{--                                                            <img src="{{ $comment->image }}" alt="">--}}
{{--                                                            <span>{{$comment->author_name}}</span>--}}
{{--                                                        </div>--}}
{{--                                                        <p> {{$comment->comment_text}}</p>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                @empty--}}
{{--                                                    <div >--}}
{{--                                                        <div >--}}
{{--                                                            <p>{{__('lms.no_comments')}}</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <hr />--}}
{{--                                                @endforelse--}}
{{--                                            </div>--}}

{{--                                        </div>--}}

{{--                                        <div class="add-replay-btn">--}}
{{--                                            @if($tick->statues && $tick->statues != "0")--}}
{{--                                                <button class="Cancel-last"> {{__('lms.ticket_cancel')}}</button>--}}
{{--                                            @else--}}
{{--                                                <input class="sm-creat-reblay creat-reblay create-ticket-comment" data-ticket-id="{{$tick->id}}" value="{{__('lms.ticket_create')}}">--}}
{{--                                                <button class="Cancel-last"> {{__('lms.ticket_cancel')}}</button>--}}
{{--                                            @endif--}}


{{--                                        </div>--}}




{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                                @endforeach--}}



{{--                            <!-- **************** end ticket-opened -->--}}
{{--                            <!-- **************** start ticket-replay -->--}}
{{--                            <div class="ticket-replay">--}}
{{--                                <div class="fk-layer-ticket"></div>--}}
{{--                                <div class="creat-ticket-form">--}}
{{--                                    <div class="close-ticket">--}}
{{--                                        <i class="fa-solid fa-circle-xmark"></i>--}}
{{--                                    </div>--}}
{{--                                    <form class="creat-reblay-popup" action=""  method="POST" enctype="multipart/form-data">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="ticket_id" value="">--}}
{{--                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">--}}
{{--                                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">--}}
{{--                                        <input type="hidden" name="type" value="Business">--}}

{{--                                        <div class="ticket-description-title">--}}
{{--                                            <span class="ticket-title">--}}
{{--                                                {{__('lms.ticket')}}--}}
{{--                                            </span>--}}
{{--                                            <div class="upload-ticket-img">--}}
{{--                                                <div class="upload-img-sec">--}}
{{--                                                    <div class="br-upload">--}}
{{--                                                        <label class="upload-label"--}}
{{--                                                               for="multiple-files"><span></span></label>--}}
{{--                                                        <input class="upload-input" id="image" type="file"--}}
{{--                                                               accept=".gif, .jpg, .png" multiple="multiple"--}}
{{--                                                               name="image"/>--}}
{{--                                                        <div class="upload-list"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-base mt-1"></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="sm-form-tik">--}}
{{--                                            <div class="ticket-details">--}}
{{--                                                <div class="sm-label sm-textarea ">--}}
{{--                                                    <label for="comment_text">{{__('lms.ticket_description')}} </label>--}}
{{--                                                    <textarea name="comment_text" id="" cols="10" rows="4"></textarea>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="action-btn">--}}

{{--                                            <button class="Create-last creat-reblay" type="submit"> {{__('lms.ticket_create')}}</button>--}}
{{--                                            <button class="Cancel-last" > {{__('lms.ticket_cancel')}}</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- **************** end ticket-replay -->--}}
{{--                            <!-- ************ creat tickets******************* -->--}}
{{--                        </div>--}}

                    </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core-init.js">
    </script>
    <script>
        $(document).ready(function(){
            $('#logou').click(function(){
                $("#logoutform").submit();
            });
        })
    </script>
    <script>
        $(document).on('click','.create-ticket-comment',function (){
            var id = $(this).attr('data-ticket-id');
            var url = "{{ route('admin.tickets.storeBusinessComment', 'id:id') }}";
            url =url.replace('id:id',id);
            $('.creat-reblay-popup').attr('action',url);
            $("input[name='ticket_id']").val(id);

        })

    </script>
    <script>
        $(document).ready(function(e) {

            $('#personal_photo').change(function() {
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
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
