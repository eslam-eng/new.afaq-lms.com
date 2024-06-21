@extends('frontend.personalInfos.index')
@section('title' ,__('global.my_profile'))
@section('myprofile')

    <div class="myprofile-page container sit-container">
        <div class="profile-img-stm">
            <img id="personal_img" src="{{ asset(auth()->user()->personal_photo->url ?? '/default.png') }}" alt="">
            <div class="select-img-file">
                <div class="wrap select-img-file-wrap">
                    <form action="{{ url(app()->getLocale() . '/update_personal_photo') }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="file lms-select-img-file">
                            <div class="file__input" id="onfile__input1">
                                <input id="personal_photo" class=" select_personal_photo" type="file"
                                    name="personal_photo" />
                                <label class=" select-img-file-wrap-lms stm-lms-select-profileimg" for="customFile-img"
                                    data-text-btn="Upload"><i class="fas fa-pen"></i></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
        <form method="post" action="{{ url(app()->getLocale() . '/edit_myprofile') }}" id="infoForm"
            enctype="multipart/form-data">
            @csrf


            <div class="profile-lms all-courses-nd member-ship-lms">
                <span class="  profile-sna">
                     {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? '' }}

                </span>

                <!-- <span></span> -->
            </div>
            <div class="myprofile-page-form">
                <span class="  myprofile-title"><h3>{{ __('lms.personal_info') }}</h3></span>
                <div class="row mt-2 mb-2">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label  class="required d-block" for="full_name_en">{{ trans('frontend.register.Full Name English') }} </label>
                            <input disabled
                                   class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}"
                                   type="text" name="full_name_en" id="full_name_en" minlength="3"
                                   maxlength="50" value="{{ old('full_name_en', $data->full_name_en) }}"
                                   required
                                   placeholder="{{ trans('frontend.register.Full Name English') }}">

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block"  for="full_name_en">{{ trans('frontend.register.Full Name English') }} </label>
                            <input disabled
                                   class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}"
                                   type="text" name="full_name_en" id="full_name_en" minlength="3"
                                   maxlength="50" value="{{ old('full_name_en', $data->full_name_en) }}"
                                   required
                                   placeholder="{{ trans('frontend.register.Full Name English') }}">

                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block"  for="email">{{ trans('frontend.register.Email') }}
                               </label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   disabled type="email" name="email"
                                   required
                                   placeholder="{{ trans('frontend.register.Email') }}"
                                   value="{{ old('email', $data->email) }}">

                        </div>
                    </div>
{{--                    <div class="col-lg-3 col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="required d-block"--}}
{{--                                for="phone">{{ trans('frontend.register.Phone Number') }} </label>--}}
{{--                            <input  disabled class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"--}}
{{--                                   name="phone[full]" id="phone" maxlength="14" aria-valuemax="14" type="tel"--}}
{{--                                    value="{{ old('phone',  $data->phone) }}"  required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="row mt-2 mb-2">

                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <label class="required d-block" for="birth_date">{{ __('lms.date_birth') }}</label>
                            <input class="form-control " type="date" name="birth_date" id="birth_date"
                                   value="{{ old('birth_date', $data->birth_date ? $data->birth_date : '') }}"
                                   placeholder="2021, Nov 22" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <label class="required d-block" for="specialty_id">{{ __('lms.personal_Field') }}</label>
                            <select onchange="get_sub_specialists()" class="form-control col-auto d-inline"
                                id="specialty_id" name="specialty_id" disabled>
                                @if ($specialists)
                                    @foreach ($specialists as $specialist)
                                        <option value="{{ $specialist->id }}"
                                            {{ old('specialty_id', $data->specialty_id) == $specialist->id ? 'selected' : '' }}>
                                            {{ $specialist->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12" id="sub">
                        <div class="form-group">
                            <label class="d-block" for="sub_specialty_id">{{ __('lms.accurate_Field') }}</label>

                            <div id="subs">
                                <select class="form-control col-auto d-inline" id="sub_specialty_id" name="sub_specialty_id"
                                    disabled>
                                    @if ($sup_specialists)
                                        @foreach ($sup_specialists as $sub_specialist)
                                            <option value="{{ $sub_specialist->id }}"
                                                {{ old('sub_specialty_id', $data->sub_specialty_id) == $sub_specialist->id ? 'selected' : '' }}>
                                                {{ $sub_specialist->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="invalid-feedback"></div>
                            @if ($errors->has('sub_specialty_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_specialty_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if (isset($data->specialty->id) && !in_array($data->specialty->id, [5, 3]))
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label class="required d-block" for="degree">{{ __('lms.Degree') }}</label>
                                <input class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" type="text"
                                    name="degree" id="degree" value="{{ old('degree', $data->degree) }}"
                                    placeholder="{{ __('lms.Degree') }}" required>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label class="required d-block"
                                    for="sub_degree">{{ __('lms.Degree_Specialization') }}</label>
                                <input class="form-control {{ $errors->has('sub_degree') ? 'is-invalid' : '' }}"
                                    type="text" name="sub_degree" id="sub_degree"
                                    value="{{ old('sub_degree', $data->sub_degree) }}"
                                    placeholder="{{ __('lms.Degree_Specialization') }}" required>
                            </div>
                        </div>

                        @if (isset($data->specialty->id) && !in_array($data->specialty->id, [9, 10]))
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label
                                    for="occupational_classification_number">{{ __('frontend.register.occupational_classification_number') }}</label>
                                @if ($data->occupational_classification_number != null )

                                    <div class="mini-input"><h5> {{ $data->occupational_classification_number }}</h5></div>
                                @else
                                    <input
                                        class="form-control {{ $errors->has('occupational_classification_number') ? 'is-invalid' : '' }}"
                                        type="number" name="occupational_classification_number"
                                        id="occupational_classification_number"
                                        value="{{ old('occupational_classification_number', $data->occupational_classification_number) }}"
                                        placeholder="{{ __('frontend.register.occupational_classification_number') }}">
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                <div class=" myprofile-title prfile-onend mt-5">
                    <h3> {{ __('lms.job_info') }}</h3>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block" for="job_place">{{ __('lms.Employer') }}</label>
                            <input class="form-control {{ $errors->has('job_place') ? 'is-invalid' : '' }}" type="text"
                                name="job_place" id="job_place" value="{{ old('job_place', $data->job_place) }}"
                                placeholder="{{ __('lms.Employer') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block" for="job_name">{{ __('lms.Job_title') }}</label>
                            <input class="form-control {{ $errors->has('job_name') ? 'is-invalid' : '' }}" type="text"
                                name="job_name" id="job_name" value="{{ old('job_name', $data->job_name) }}"
                                placeholder="{{ __('lms.Job_title') }}" required>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block" for="country">{{ __('lms.Country') }}</label>
                            <select class="form-control col-auto d-inline" id="country" name="country">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}"
                                        {{ old('country', $data->country) == $country->name ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label class="required d-block" for="city">{{ __('lms.City') }}</label>
                            <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text"
                                name="city" id="city" value="{{ old('city', $data->city) }}"
                                placeholder="{{ __('lms.City') }}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sae-btn-lms-stm">
                <button type="submit" onclick="$('#infoForm').submit()">{{ __('lms.Save') }}</button>
            </div>
        </form>
    </div>

@endsection
<script>
    function get_sub_specialists() {
        var id = $('#specialty_id').val();
        if (id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/{{ app()->getLocale() }}/get_specialty/' + id,
                success: function(data) {
                    var subuser = `
                <select class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}" name="sub_specialty_id" id="sub_specialty_id">
                `;
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        subuser += `<option value="` + element.id + `">` + element.name + `</option>`
                    }

                    subuser += `</select>`;

                    $('#subs').html(subuser);
                    $('#sub').show();

                }
            });
        }
    }

</script>
