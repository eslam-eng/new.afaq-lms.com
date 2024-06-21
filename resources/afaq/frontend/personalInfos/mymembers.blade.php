@extends('frontend.personalInfos.index')
@section('myprofile')
    <div class="myprofile-page">
        <div class=" myprofile-title">
            <h3> {{ __('lms.member_info') }}</h3>
        </div>
        @if ($user->active_membership)
            <div class="member-onlogin-stm ">
                <div class="row">
                    <div class="col-lg-3 col-md-6 hide">
                        <em class="our-work-onprofile">{{ __('lms.member_name') }}</em>
                        <span
                            class="details-work-onprofile">{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <em class="our-work-onprofile">{{ __('lms.member_number') }}</em>
                        <span
                            class="details-work-onprofile">{{ $user->active_membership->accreditation_number ?? '' }}</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <em class="our-work-onprofile">{{ __('lms.member_date') }}</em>
                        <span class="details-work-onprofile"><i
                                class="fas fa-calendar-week"></i>{{ date('Y, M d', strtotime($user->active_membership->start_date)) ?? '' }}</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <em class="our-work-onprofile">{{ __('lms.member_end_date') }}</em>
                        <span class="details-work-onprofile"><i class="fas fa-calendar-week"></i>
                            {{ date('Y, M d', strtotime($user->active_membership->end_date)) ?? '' }}</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <em class="our-work-onprofile">{{ __('lms.type') }}</em>
                        <span class="details-work-onprofile"><i class="fas fa-child"></i>
                            {{ $user->active_membership->member_type->name ?? '' }}</span>
                    </div>
                </div>
                @if ($user->active_membership->file)
                    <div class="lms-after-chose-file mt-5">
                        <a target="_blank" href="{{ $user->active_membership->file->url ?? '#' }}">
                            <div class="d-flex justify-content-between stm-filechosen">
                                <span class="file-name-lms"><i
                                        class="far fa-file-pdf"></i>{{ $user->active_membership->file->file_name }} </span>
                                <!-- <button class="delate-name-lms">مسح<i class="fas fa-trash-alt"></i></button> -->
                            </div>
                        </a>
                    </div>
                @endif

            </div>
        @elseif($user->last_membership)
            <div class="member-onlogin-stm ">
                <form method="post" action="{{ url(app()->getLocale() . '/add_mymembers') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_member_id" value="{{ $user->last_membership->id }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 hide">
                            <em class="our-work-onprofile">{{ __('lms.member_name') }}</em>
                            <span
                                class="details-work-onprofile">{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="accreditation_number">{{ __('lms.member_number') }}</label>
                                <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}"
                                    type="text" name="accreditation_number" id="accreditation_number"
                                    value="{{ old('accreditation_number', $user->last_membership->accreditation_number ?? '') }}"
                                    placeholder="رقم العضوية{{ __('lms.member_number') }}">

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('lms.member_date') }}</label>
                                <input class="form-control " type="date" name="start_date"
                                    value="{{ old('start_date', $user->last_membership->start_date ? date('Y-m-d', strtotime($user->last_membership->start_date)) : '') }}"
                                    id="start_date" placeholder="2021, Nov 22">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="end_date">{{ __('lms.member_end_date') }}</label>
                                <input class="form-control " type="date" name="end_date"
                                    value="{{ old('end_date', $user->last_membership->end_date ? date('Y-m-d', strtotime($user->last_membership->end_date)) : '') }}"
                                    id="end_date" placeholder="2021, Nov 22">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="membership_type">{{ __('lms.type') }}</label>
                                <select name="member_type_id" id="membership_type" class="form-control">
                                    <option value="" selected disabled></option>
                                    @foreach ($member_ship_types as $member_ship_type)
                                        <option value="{{ $member_ship_type->id }}"
                                            {{ $member_ship_type->id == $user->last_membership->member_type_id ? 'selected' : '' }}>
                                            {{ $member_ship_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="chose-file-lms d-flex justify-content-start mt-5">
                        <div class="stm-chose-">
                            <em class="our-work-onprofile"> {{ __('lms.upload_document') }}</em>
                        </div>
                        <div style="width: 60px;"></div>
                        <div class="stm-chose-filename">
                            <div class="wrap">
                                <div class="file">
                                    <div class="file__input" id="file__input">
                                        <input class="file__input--file" id="file" type="file" name="file" />
                                        <label class="file__input--label" for="file" data-text-btn="Upload"><i
                                                class="fas fa-file-download"></i>{{ __('lms.upload') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user->last_membership->file)
                        <div class="lms-after-chose-file mt-5">
                            <a target="_blank" href="{{ $user->last_membership->file->url ?? '#' }}">
                                <div class="d-flex justify-content-between stm-filechosen">
                                    <span class="file-name-lms"><i
                                            class="far fa-file-pdf"></i>{{ $user->last_membership->file->file_name }}
                                    </span>
                                    <!-- <button class="delate-name-lms">مسح<i class="fas fa-trash-alt"></i></button> -->
                                </div>
                            </a>
                        </div>
                    @endif
                    <div class="sae-btn-lms-stm">
                        <button type="submit">{{ __('lms.Save') }}</button>
                    </div>
                </form>
            </div>
        @else
            <div class="member-onlogout-stm ">
                <form method="post" action="{{ url(app()->getLocale() . '/add_mymembers') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <em class="our-work-onprofile">{{ __('lms.member_name') }}</em>
                            <span
                                class="details-work-onprofile">{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="accreditation_number">{{ __('lms.member_number') }}</label>
                                <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}"
                                    type="text" name="accreditation_number" id="accreditation_number"
                                    value="{{ old('accreditation_number', '') }}"
                                    placeholder="{{ __('lms.member_number') }}">

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('lms.member_date') }}</label>
                                <input class="form-control " type="date" name="start_date" id="start_date"
                                    placeholder="2021, Nov 22">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="end_date">{{ __('lms.member_end_date') }}</label>
                                <input class="form-control " type="date" name="end_date" id="end_date"
                                    placeholder="2021, Nov 22">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="membership_type">{{ __('lms.type') }}</label>
                                <select name="member_type_id" id="membership_type" class="form-control">
                                    <option value="" selected disabled></option>
                                    @foreach ($member_ship_types as $member_ship_type)
                                        <option value="{{ $member_ship_type->id }}">
                                            {{ $member_ship_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="chose-file-lms d-flex justify-content-start mt-5">
                        <div class="stm-chose-">
                            <em class="our-work-onprofile"> {{ __('lms.upload_document') }}</em>
                        </div>
                        <div style="width: 60px;"></div>
                        <div class="stm-chose-filename">
                            <div class="wrap">

                                <div class="file">
                                    <div class="file__input" id="file__input">
                                        <input class="file__input--file" id="file" type="file" name="file" />
                                        <label class="file__input--label" for="file" data-text-btn="Upload"><i
                                                class="fas fa-file-download"></i>{{ __('lms.upload') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sae-btn-lms-stm">
                        <button>{{ __('lms.Save') }}</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

@endsection
