@extends('frontend.personalInfos.index')
@section('myprofile')
    <style>
        @media screen and (max-width: 830px) {
            .precemp {
                bottom: 30px;
            }
        }
    </style>
    <div class="myprofile-page">
        <form method="post" action="{{ url(app()->getLocale() . '/edit_myprofile') }}" enctype="multipart/form-data">
            @csrf
            <div class=" myprofile-title">
                <h3> {{ __('lms.personal_info') }}</h3>
            </div>
            <div class="myprofile-page-form">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <label class="required d-block" for="birth_date">{{ __('lms.date_birth') }}</label>
                            <input class="form-control " type="date" name="birth_date" id="birth_date"
                                value="{{ old('birth_date', $data->birth_date ? date('Y-m-d', strtotime($data->birth_date)) : '') }}"
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
                                            {{ $specialist->name }}</option>
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
                                                {{ $sub_specialist->name }}</option>
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
                @if (isset($data->specialty->id) && !in_array($data->specialty->id, [5]))
                    <div class="row">
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


                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label
                                    for="occupational_classification_number">{{ __('frontend.register.occupational_classification_number') }}</label>
                                @if ($data->occupational_classification_number != null)
                                    <h5> {{ $data->occupational_classification_number }}</h5>
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

                <div class=" myprofile-title prfile-onend mt-5">
                    <h3> {{ __('lms.job_info') }}</h3>
                </div>
                <div class="row">
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
                                        {{ $country->name }}</option>
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
                <button type="submit">{{ __('lms.Save') }}</button>
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
