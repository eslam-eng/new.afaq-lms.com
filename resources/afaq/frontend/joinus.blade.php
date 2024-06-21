@extends('layouts.front')
@section('title')
    <title>{{__('frontend.join_us')}}</title>
@endsection
@section('content')
    <link rel="stylesheet" href="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core.min.css">
    <link rel="stylesheet" href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="{{ asset('afaq/assests/css/joinus.style.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/upload-img.style.css') }}" rel="stylesheet">
    {{-- *************************************** --}}
    <section class="carts-page the-card-page">
        <div class="col-12 cart-page-lms">
            {{-- <div class="br-div" style=""> </div> --}}
            <div class="col-10 offset-1">
                <div class="card-afaq-health-education">
                    <div class="afaq-bg-img">
                        <img src="/afaq/imgs/Logo-Type-1v-2.png" alt="">
                    </div>
                    <div class="afaq-health-education">
                        <strong><em>{{__('lms.afaq')}}</em><u></u> {{__('afaq.health_edu')}} </strong>
                        <p>
                            {{__('afaq.join_paragraph')}}
                        </p>
                        <div class="health-education-details">
                            <span>{{__('afaq.join_requirements')}}</span>
                            <ul>
                                <li><i class="fa-solid fa-circle"></i> <u></u>{{__('afaq.join_requirements_1')}} </li>
                                <li><i class="fa-solid fa-circle"></i><u></u>{{__('afaq.join_requirements_2')}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="afaq-form-education">
                        <form action="{{ route('become_instructor',['locale'=>app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                            @csrf
{{--                            @include('common.alert')--}}
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-icon">
                                        <i class="flaticon-warning "></i>
                                    </div>
                                    <div class="alert-text">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div><br />
                            @endif
                            <div class="form-education-details">
                                <div class="form-col">

                                    <label for="name_ar">{{__('lms.Fullname')}}</label>
                                    <input type="text" name="name_ar"  id="name_ar" minlength="2" maxlength="45" required>
                                    @if($errors->has('name_ar'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name_ar') }}
                                        </div>
                                    @endif
                                </div>
{{--                                <div class="form-col">--}}
{{--                                    <label for="">{{__('lms.Specialization')}}</label>--}}
{{--                                    <input type="text">--}}
{{--                                </div>--}}

                                <div class="form-col">
                                    <label for="specialty_id">{{__('lms.Specialization')}}</label>
                                    <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required="required">
                                        @foreach($specializations as $id => $entry)
                                            <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('specialty'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('specialty') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.notificationCampain.fields.specialty_helper') }}</span>
                                </div>



                                <div class="form-col">
                                    <label for="job_title">{{__('lms.JobTitle')}}</label>
                                    <input type="text" name="job_title" id="job_title" required="required"  >
                                    @if($errors->has('job_title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('job_title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-col">
                                    <label for="workplace">{{__('afaq.Workplace')}}</label>
                                    <input type="text" name="workplace" id="workplace" required="required"  >
                                    @if($errors->has('workplace'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('workplace') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-col">
                                    <label>{{ trans('cruds.instructor.fields.recent_work') }}</label>

                                        <div class=" radio-details  {{ $errors->has('recent_work') ? 'is-invalid' : '' }}">
                                            @foreach(App\Models\Instructor::RECENT_WORK_RADIO as $key => $label)
                                            <div class="radio-btn">
                                            <input class="form-check-input " type="radio" id="recent_work_{{ $key }} radio-btn" name="recent_work" value="{{ $key }}" {{ old('recent_work', '') === (string) $key ? 'checked' : '' }} required="required">
                                            <label class="form-check-label " for="recent_work_{{ $key }}">{{ __('global.'.$label) }}</label>
                                            </div>
                                            @endforeach
                                        </div>

                                    @if($errors->has('recent_work'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('recent_work') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.instructor.fields.recent_work_helper') }}</span>
                                </div>




                                <div class="form-col">

                                    <label for="">{{__('afaq.Mobile_Number')}}</label>
                                    <input  type="tel" name="mobile" id="phone" required="required">
                                    @if($errors->has('mobile'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mobile') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-col">
                                    <label for="mail">{{__('afaq.Email_address')}}</label>

                                    <input type="email"  id="mail" name="mail"  required="required">
                                    @if($errors->has('mail'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mail') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-col">
                                    <label for="twitter_account">{{__('afaq.Twitter_Account')}}</label>
                                    <input type="text" name="twitter_account" id="twitter_account" required="required">
                                    @if($errors->has('twitter_account'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('twitter_account') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-col">
                                    <label for="resume">{{__('afaq.Resume')}}</label>


                                    <div class="fileContainer sprite">
                                        <span>{{__('lms.upload_img')}}</span>
                                        <input id="file" type="file" name="resume" accept=".doc, .docx,.txt,.pdf">
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-btn">
                                    <button type="submit">{{__('afaq.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <script src="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core-init.js"></script>
    @endsection
    @section('scripts')
        <script>
            @if(Session::has('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('message') }}");
        @endif
        </script>
    @endsection
