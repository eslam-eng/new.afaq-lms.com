@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 55vh !important;
    }

    .all-courses-nd {
        bottom: 160px;
    }

    .precemp {
        bottom: 180px;
    }
    @media screen and (max-width: 1200px) {
        .innerheader-nd {
        height: 65vh !important;
    }
    }
    @media screen and (max-width: 830px) {
      .precemp {
      bottom: 30px;
   }
}
</style>
<section class="idu-programss">
    <div class="container sit-container">
        <div class="profile-lms all-courses-nd member-ship-lms justify-content-evenly">
            <span class="profile-sna ">{{ trans('cruds.personalInfo.title') }}</span>
        </div>
        <div class="stm-lms-profile-img">
            <div class="select-chose-file">
                <div class="profile-img-stm">
                    <img id="personal_img" src="{{ asset( auth()->user()->personal_photo->url ?? '/default.png')}}" alt="">
                    <div class="select-img-file">
                        <div class="wrap select-img-file-wrap">
                            <form action="{{url(app()->getLocale().'/update_personal_photo')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="file lms-select-img-file">
                                    <div class="file__input" id="onfile__input1">
                                        <input id="personal_photo" class=" select_personal_photo" type="file" name="personal_photo" />
                                        <label class=" select-img-file-wrap-lms stm-lms-select-profileimg" for="customFile-img" data-text-btn="Upload"><i class="fas fa-pen"></i></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="stm-lms-profile-name">
                <span>{{app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? ''}}</span>
                <em>{{auth()->user()->job_name ?? ''}}</em>
                @if(auth()->user()->country || auth()->user()->city)
                <i>
                    <i class="fas fa-map-marker-alt"></i>
                    {{auth()->user()->country ??''}},{{auth()->user()->city ??''}}
                </i>
                @endif
            </div>
            <div class="out-fitlayer"></div>
        </div>


        <div class=" profile-tabs-lms d-flex align-items-start justify-content-between">
            <div class="right-profile-tabe-lms nav nav-pills me-3">
                <a href="{{url(app()->getLocale() . '/myprofile')}}" class="nav-link {{Request::segment(2) == 'myprofile' || Request::segment(2) == 'personal-infos' ? 'active' : ''}}"><i class="fas fa-user"></i> {{__('lms.my_account')}}</a>
                <a href="{{url(app()->getLocale() . '/mymembers')}}" class="nav-link {{Request::segment(2) == 'mymembers' ? 'active' : ''}}"><i class="fas fa-id-card"></i>{{__('lms.membership')}}</a>
                <a href="{{url(app()->getLocale() . '/my_invoices')}}" class="nav-link {{Request::segment(2) == 'my_invoices' ? 'active' : ''}}"><i class="fas fa-file-invoice"></i> {{__('lms.my_invoices')}}</a>
                <a href="{{url(app()->getLocale() . '/mycourses')}}" class="nav-link {{Request::segment(2) == 'mycourses' ? 'active' : ''}}"><i class="fa-sharp fa-solid fa-layer-group"></i> {{__('lms.my_courses')}}</a>
                <a href="{{url(app()->getLocale() . '/wallet')}}" class="nav-link {{Request::segment(2) == 'wallet' ? 'active' : ''}}"><i class="fa-solid fa-wallet"></i> <em>{{__('lms.wallet_and_points')}}</em></a>
                <a href="{{url(app()->getLocale() . '/my_certificates')}}" class="nav-link {{Request::segment(2) == 'my_certificates' ? 'active' : ''}}"><i class="fa-solid fa-certificate"></i> {{__('lms.my_certificates')}}</a>
                <a href="{{url(app()->getLocale() . '/my_exams')}}" class="nav-link {{Request::segment(2) == 'my_exams' ? 'active' : ''}}"><i class="fa-solid fa-envelope-open-text"></i> {{__('lms.my_exams')}}</a>
                {{-- <a href="{{url(app()->getLocale() . '/my_quizes')}}" class="nav-link {{Request::segment(2) == 'my_quizes' ? 'active' : ''}}"><i class="fa-solid fa-envelope-open-text"></i> {{__('lms.my_quizes')}}</a> --}}
                <a href="{{url(app()->getLocale() . '/changemypassword')}}" class="nav-link {{Request::segment(2) == 'changemypassword' ? 'active' : ''}}"><i class="fas fa-lock-open"></i>{{__('lms.change_password')}} </a>
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    {{__('lms.Logout')}}
                </a>
                <form id="logoutform" action="{{ route('logout' ,['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="left-profile-tabe-lms tab-content">
                @yield('myprofile')
            </div>
        </div>


    </div>

</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function(e) {
        function get_sub_specialists() {
            var id = $('#specialty_id').val();
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{app()->getLocale()}}/get_specialty/' + id,
                    success: function(data) {
                        var subuser = ` `;
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id + `">` + element.name + `</option>`
                        }

                        subuser += ``;

                        $('#sub_specialty_id').html(subuser);
                        $("#sub_specialty_id").select2().select2('text', $('#sub_specialty_id').val());
                    }
                });
            }
        }

        $('#sort').on('change', function(e) {
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $('#' + item).val();
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });


        $('.filter').on('click', function(e) {
            cleanUrl();
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $(this).attr('value');
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });

        $('.btn_filter').on('click', function(e) {
            var item = $('#text').attr('name');
            var value = $('#text').val();
            if (value != '') {
                cleanUrl();
                var url = window.location.href;
                url = updateQueryStringParameter(url, item, value);
                window.location = url;
            } else {
                alert('please, type text in search box ...')
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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


@endsection
