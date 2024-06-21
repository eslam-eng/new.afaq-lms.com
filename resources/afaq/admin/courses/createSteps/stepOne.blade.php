<h6>{{ trans('global.step') }} 1</h6>
<fieldset>
    <div class="row col-12 ">
        <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">
            <input type="checkbox" class="custom-control-input" id="status" name="show_in_homepage" data-parsley-group="step-1"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="Hide from home" data-on="Show in home">
            <label class="custom-control-label" for="status">
                <span class="switch-text-right">Hide from home</span>
                <span class="switch-text-left">Show in home</span>
            </label>
        </div>
        <div class="row col-12 mt-2">
            <div class="form-group col-4">
                <label class="required label-waves-effect required" style="position:relative; top:0;"
                    for="course_track_id">{{ trans('cruds.course.fields.course_track') }}</label>
                <i>*</i>
                <select class="form-control select2" name="course_track_id" id="course_track_id" required
                    data-parsley-errors-container="#course_tracks" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                    <option value="" disabled selected></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_tracks')
                            <option value="{{ $lookup->id }}">
                                {{ $lookup->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div id="course_tracks"></div>
            </div>
            <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_collaboration_id">{{ trans('cruds.course.fields.course_collaboration') }}</label>

                    <select class="form-control select2" name="course_collaborations[]" multiple
                        id="course_collaboration_id" data-parsley-errors-container="#course_collaborations"
                        data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_collaborations')
                                <option value="{{ $lookup->id }}">
                                    {{ $lookup->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="course_collaborations"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                        style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                        data-toggle="modal" data-target="#exampleModal" lookup-type="course_collaborations"
                        lookup-title="{{ trans('cruds.course.fields.course_collaboration') }}"
                        select-id="course_collaboration_id">
                        +
                    </button>
                </div>
            </div>
            <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_sponsor_id">{{ trans('cruds.course.fields.course_sponsor') }}</label>

                    <select class="form-control select2" name="course_sponsors[]" id="course_sponsor_id"
                        multiple data-parsley-errors-container="#course_sponsors" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_sponsors')
                                <option value="{{ $lookup->id }}">
                                    {{ $lookup->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="course_sponsors"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                        style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                        data-toggle="modal" data-target="#exampleModal" lookup-type="course_sponsors"
                        lookup-title="{{ trans('cruds.course.fields.course_sponsor') }}" select-id="course_sponsor_id">
                        +
                    </button>
                </div>
            </div>
            {{-- <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">

                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_classification_id">{{ trans('cruds.course.fields.course_classification') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="course_classification_id" id="course_classification_id"
                        required data-parsley-errors-container="#course_classifications" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        onchange="getSubClassifications($(this).val())">
                        <option value="" disabled selected></option>
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_classifications' && $lookup->parent_id == null)
                                <option value="{{ $lookup->id }}">
                                    {{ $lookup->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="course_classifications"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                        style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                        data-toggle="modal" data-target="#exampleModal" lookup-type="course_classifications"
                        lookup-title="{{ trans('cruds.course.fields.course_classification') }}"
                        select-id="course_classification_id">
                        +
                    </button>
                </div>
            </div> --}}
            {{-- <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_sub_classification_id">{{ trans('cruds.course.fields.course_sub_classification') }}</label>

                    <select class="form-control select2" name="course_sub_classifications[]"
                        id="course_sub_classification_id" multiple
                        data-parsley-errors-container="#course_sub_classifications" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">

                    </select>
                    <div id="course_sub_classifications"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                        style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                        data-toggle="modal" data-target="#exampleModal" lookup-type="course_classifications"
                        lookup-title="{{ trans('cruds.course.fields.course_sub_classification') }}" lookup-sub="1"
                        select-id="course_sub_classification_id">
                        +
                    </button>
                </div>
            </div> --}}
            <div class="form-group col-4">
                <label class="required label-waves-effect required" style="position:relative; top:0;" for="category_id">{{ trans('cruds.course.fields.category') }}</label>
                <i>*</i>

                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"  name="category_id" id="category_id" data-parsley-group="step-1" required>
                    @foreach($categories as $id => $entry)
                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                <div class="invalid-feedback">
                    {{ $errors->first('category') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.category_helper') }}</span>
            </div>
            <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_availability_id">{{ trans('cruds.course.fields.course_availability') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="course_availability_id" id="course_availability_id"
                        required data-parsley-errors-container="#course_availabilities" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        onchange="getTimeInputs($(this).val())">
                        <option value="" disabled selected></option>
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_availabilities')
                                <option value="{{ $lookup->slug }}">
                                    {{ $lookup->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="course_availabilities"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                        style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                        data-toggle="modal" data-target="#exampleModal" lookup-type="course_availabilities"
                        lookup-title="{{ trans('cruds.course.fields.course_availability') }}"
                        select-id="course_availability_id">
                        +
                    </button>
                </div>
            </div>
            <div class="form-group col-4 d-flex">
                <div class="col-11 px-0">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                           for="course_organizer_id">{{ trans('cruds.course.fields.course_organizer') }}</label>

                    <select class="form-control select2" name="course_organizers[]" multiple
                            id="course_organizer_id" data-parsley-errors-container="#course_organizers"
                            data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_organizers')
                                <option value="{{ $lookup->id }}">
                                    {{ $lookup->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="course_organizers"></div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn create-lookup"
                            style=" margin-top: 1.5rem;
                                                                    font-size: 2rem;
                                                                    padding: 0;"
                            data-toggle="modal" data-target="#exampleModal" lookup-type="course_organizers"
                            lookup-title="{{ trans('cruds.course.fields.course_organizer') }}"
                            select-id="course_organizer_id">
                        +
                    </button>
                </div>
            </div>
            {{-- <div class="form-group col-4 anticipated_date" style="display: none;">
                <label class="required label-waves-effect required" style="position:relative; top:0;"
                    for="anticipated_date">{{ trans('cruds.course.fields.anticipated_date') }}</label>
                <i>*</i>
                <input type="datetime-local" name="anticipated_date" class="form-control datetimepicker"
                    id="anticipated_date" data-parsley-errors-container="#anticipated_date_error"
                    data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                <div id="anticipated_date_error"></div>
            </div> --}}

        </div>

        <div class="row col-12">
            <div class="form-group col-4">
                <label class="required label-waves-effect required" style="position:relative; top:0;"
                    for="course_accreditation_id">{{ trans('cruds.course.fields.course_accreditation') }}</label>
                <i>*</i>
                <select class="form-control select2" name="course_accreditation_id" id="course_accreditation_id"
                    required data-parsley-errors-container="#course_accreditations" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                    onchange="getAccrediteInputs($(this).val())">
                    <option value="" disabled selected></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_accreditations')
                            <option value="{{ $lookup->slug }}">
                                {{ $lookup->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div id="course_accreditations"></div>
            </div>
            <div class="col-8  accreditation-hidden-section  row mx-0 p-0" style="display:none !important;">
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="certificate_number">{{ trans('cruds.course.fields.certificate_number') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('certificate_number') ? 'is-invalid' : '' }}"
                        type="text" name="accreditation_number" id="certificate_number"
                        data-parsley-errors-container="#certificate_number_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        value="">
                    <div id="certificate_number_error"></div>
                    @if ($errors->has('certificate_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('certificate_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.certificate_number_helper') }}</span>
                </div>

                <div class="form-group col-6  accedit-hours-input">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="credit_hours">{{ trans('cruds.course.fields.credit_hours') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('credit_hours') ? 'is-invalid' : '' }}" type="number"
                        name="accredit_hours" id="credit_hours" data-parsley-errors-container="#credit_hours_error"
                        data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}" value="">
                    <div id="credit_hours_error"></div>
                    @if ($errors->has('credit_hours'))
                        <div class="invalid-feedback">
                            {{ $errors->first('credit_hours') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.credit_hours_helper') }}</span>
                </div>
            </div>
        </div>
        <div class="row col-12">
            <div class="form-group col-4">
                <label class="required label-waves-effect required" style="position:relative; top:0;"
                    for="course_place_id">{{ trans('cruds.course.fields.course_place') }}</label>
                <i>*</i>
                <select class="form-control select2" name="course_place_id" id="course_place_id" required
                    data-parsley-errors-container="#course_places_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                    onchange="showPlaceSection($(this).val())">
                    <option value="" disabled selected></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_places')
                            <option value="{{ $lookup->slug }}">
                                {{ $lookup->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div id="course_places_error"></div>

            </div>

            <div class="row col-12  place-hidden-section" style="display:none !important;">
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                           for="attendanceDesign">{{ trans('cruds.attendanceDesign.title_singular') }}</label>
                    <i>*</i>
                    <select class="form-control select2 " name="attendance_design_id[]" id="attendance_design_id[]"
                            data-parsley-errors-container="#attendanceDesign_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                    >
                        <option value="" disabled selected></option>
                        @foreach ($attendance_designs as $attendance_design)
                            <option value="{{ $attendance_design->id }}">
                                {{ $attendance_design->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <label>{{ trans('cruds.course.fields.attend_type') }}</label>
                    <select class="form-control {{ $errors->has('attend_type') ? 'is-invalid' : '' }}"
                            data-parsley-group="step-1" data-parsley-errors-container="#attend_type_error" data-parsley-required-message="{{ trans('global.required') }}" name="attend_type" id="attend_type">
                        <option value disabled {{ old('attend_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Course::ATTEND_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('attend_type', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.course.fields.'.$label)  }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('attend_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('attend_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.attend_type_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="country">{{ trans('cruds.course.fields.country') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="country_id" id="country_id"
                        data-parsley-errors-container="#country_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        onchange="getCities($(this).val())">
                        <option value="" disabled selected></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->title }}</option>
                        @endforeach
                    </select>
                    <div id="country_error"></div>

                    <span class="help-block">{{ trans('cruds.course.fields.country_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="city">{{ trans('cruds.course.fields.city') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="city_id" id="city_id" onchange="setCityValue($(this).val())"
                        data-parsley-errors-container="#city_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                        <option value="" disabled selected></option>

                    </select>
                    <div id="city_error"></div>

                    <span class="help-block">{{ trans('cruds.course.fields.city_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                           for="detailed_address">{{ trans('cruds.course.fields.detailed_address') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('detailed_address') ? 'is-invalid' : '' }}" type="text" name="detailed_address"
                           id="detailed_address" value="{{ old('detailed_address', '') }}"
                           data-parsley-errors-container="#course_detailed_address" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                    >
                    @if ($errors->has('detailed_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('detailed_address') }}
                        </div>
                    @endif
                    <div id="course_detailed_address"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.detailed_address_helper') }}</span>
                </div>





                <div class="form-group col-12">
                    <input type="text" id="address" name="location" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="location">{{ trans('cruds.course.fields.location') }}</label>
                    <i>*</i>
                    <div id="map" style="width: 100%;height: 500px;"></div>
                    <input type="hidden" name="lat" id="lat"
                        data-parsley-errors-container="#location_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                    <input type="hidden" name="lng" id="lng"
                        data-parsley-errors-container="#location_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                    <div id="location_error"></div>
                    @if ($errors->has('location'))
                        <div class="invalid-feedback">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.location_helper') }}</span>
                </div>
            </div>
        </div>
    </div>
</fieldset>
