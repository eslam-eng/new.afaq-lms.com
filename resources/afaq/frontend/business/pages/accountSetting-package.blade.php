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
                            <a href="{{ url(app()->getLocale() . '/business-personal-infos') }}">
                                <div class="afaq-acc-name  my-acc">
                                    <em class="show"> <img src="{{asset('afaq/business/imgs/fff-1.svg')}}" alt=""> </em>
                                    <em class="hide"> <img src="{{asset('afaq/business/imgs/fff.svg')}}" alt=""> </em>
                                    <span class="w-15-"></span>
                                    <span>{{ __('lms.my_account') }}</span>
                                </div>
                            </a>

                            <a href="#">
                                <div class="afaq-acc-name active Packages">
                                    <em class="show"> <img src="{{asset('afaq/business/imgs/apps (-1.svg')}}" alt=""> </em>
                                    <em class="hide"> <img src="{{asset('afaq/business/imgs/apps (1).svg')}}" alt=""> </em>
                                    <span class="w-15-"></span>
                                    <span>{{ __('lms.my_packages') }}</span>
                                </div>
                            </a>




                            <a href="{{ url(app()->getLocale() . '/business_invoices') }}">
                                <div class="afaq-acc-name Invoices">
                                    <em class="show"> <img src="{{asset('afaq/business/imgs/saxs-1.svg')}}" alt=""> </em>
                                    <em class="hide"> <img src="{{asset('afaq/business/imgs/saxs.svg')}}" alt=""> </em>
                                    <span class="w-15-"></span>
                                    <span>{{ __('lms.my_invoices') }}</span>
                                </div>
                            </a>
                            <a href="{{ url(app()->getLocale() . '/business_tickets') }}">
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
                         {{__('afaq.package_expire_at')}}  </span>

                        <!-- Package empty -->

                            @if($package_payment->count() == 0)
                        <div class="Packages-form acc-detials-form show">
                            <div class="package-title on-web">
{{--                                <strong>Packages</strong>--}}
                            </div>
                            <div class="packages-card">
                                <div class="all-evnts pack-evnts">
                                    <div class="img-evnt">
                                        <div class="img-ev-logo">
                                            <img src="{{asset('afaq/business/imgs/Layer 18.svg')}}" alt="">
                                        </div>
                                        <span>{{__('afaq.All_Events')}}</span>
                                    </div>
                                    <em>0</em>
                                </div>
                                <div class="used-events pack-evnts">
                                    <div class="img-evnt">
                                        <div class="img-ev-logo">
                                            <img src="{{asset('afaq/business/imgs/speedometer_4399711.svg')}}" alt="">
                                        </div>
                                        <span>{{__('afaq.Used_Events')}}</span>
                                    </div>
                                    <em>0</em>
                                </div>
                                <div class="your-balance pack-evnts">
                                    <div class="img-evnt">
                                        <div class="img-ev-logo">
                                            <img src="{{asset('afaq/business/imgs/wallet_483742.svg')}}" alt="">
                                        </div>
                                        <span>{{__('lms.my_balance')}}</span>
                                    </div>
                                    <em>0 <small>SAR</small></em>
                                </div>
                            </div>

                        </div>
                        @endif
                        <!--  End   package empty  -->






                        <div class="Packages-form acc-detials-form show">

                            @foreach($package_payment as $pack_pay)
                                <div class="package-title on-web">
                                    <strong>
                                     {{__('afaq.your_package')}} {{ app()->getLocale() == 'en' ? $pack_pay->package_name_en ?? '' : $pack_pay->package_name_ar ?? '' }}

                                    </strong>
                                </div>
                                <div class="packages-card">
                                    <div class="all-evnts pack-evnts">
                                        <div class="img-evnt">
                                            <div class="img-ev-logo">
                                                <img src="{{asset('afaq/business/imgs/Layer 18.svg')}}" alt="">
                                            </div>
                                            <span>{{__('afaq.All_Events')}}</span>
                                        </div>
                                        <em>{{$pack_pay->event_number ?? ''}}</em>
                                    </div>
                                    <div class="used-events pack-evnts">
                                        <div class="img-evnt">
                                            <div class="img-ev-logo">
                                                <img src="{{asset('afaq/business/imgs/speedometer_4399711.svg')}}" alt="">
                                            </div>
                                            <span>{{__('afaq.Used_Events')}}</span>
                                        </div>
                                        <em>0</em>
                                    </div>
                                    <div class="your-balance pack-evnts">
                                        <div class="img-evnt">
                                            <div class="img-ev-logo">
                                                <img src="{{asset('afaq/business/imgs/wallet_483742.svg')}}" alt="">
                                            </div>
                                            <span>{{__('lms.my_balance')}}</span>
                                        </div>
                                        <em>0 <small>SAR</small></em>
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
