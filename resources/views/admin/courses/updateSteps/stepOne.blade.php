<h6>{{ trans('global.step') }} 1</h6>
<fieldset>
    <div class="row col-12 ">
        <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">
            <input type="checkbox" class="custom-control-input" id="status"  data-parsley-group="step-1" {{ $course->show_in_homepage ? 'checked' : '' }} name="show_in_homepage"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="Hide from home" data-on="Show in home">
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
                    <option value="" disabled></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_tracks')
                            <option value="{{ $lookup->id }}" {{($lookup->id == $course->course_track_id) ? 'selected' : ''}}>
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
                                <option value="{{ $lookup->id }}"  {{( in_array($lookup->id,$selected_course_collaborations)) ? 'selected' : ''}}>
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
                                <option value="{{ $lookup->id }}" {{( in_array($lookup->id,$selected_course_sponsors)) ? 'selected' : ''}}>
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
                        <option value="" disabled></option>
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_classifications' && $lookup->parent_id == null)
                                <option value="{{ $lookup->id }}" {{($lookup->id == $course->course_classification_id) ? 'selected' : ''}}>
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
            </div>
            <div class="form-group col-4 d-flex">
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
                <label class="required label-waves-effect" style="position:relative; top:0;" for="category_id">{{ trans('cruds.course.fields.category') }}</label>
                <i>*</i>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" data-parsley-group="step-1" required>
                    @foreach($categories as $id => $entry)
                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $course->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="" disabled></option>
                        @foreach ($lookups as $lookup)
                            @if ($lookup->type->slug == 'course_availabilities')
                                <option value="{{ $lookup->slug }}" {{($lookup->id == $course->course_availability_id) ? 'selected' : ''}}>
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
            {{-- <div class="form-group col-4 anticipated_date" style="display: none;">
                <label class="required label-waves-effect required" style="position:relative; top:0;"
                    for="anticipated_date">{{ trans('cruds.course.fields.anticipated_date') }}</label>
                <i>*</i>
                <input type="datetime-local" name="anticipated_date" class="form-control datetimepicker"
                    id="anticipated_date" data-parsley-errors-container="#anticipated_date_error"
                    data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}" value="{{$course->anticipated_date}}">
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
                    <option value="" disabled></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_accreditations')
                            <option value="{{ $lookup->slug }}" {{($lookup->id == $course->course_accreditation_id) ? 'selected' : ''}}>
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
                        value="{{$course->accreditation_number}}">
                    <div id="certificate_number_error"></div>
                    @if ($errors->has('certificate_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('certificate_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.certificate_number_helper') }}</span>
                </div>
                {{-- <div class="form-group col-3">
                                                                <label class="required label-waves-effect"
                                                                    style="position:relative; top:0;"
                                                                    for="certificate_price">{{ trans('cruds.course.fields.certificate_price') }}</label>
                                                                <i>*</i>
                                                                <input
                                                                    class="form-control {{ $errors->has('certificate_price') ? 'is-invalid' : '' }}"
                                                                    type="text" name="certificate_price"
                                                                    id="certificate_price"
                                                                    data-parsley-errors-container="#certificate_price_error"
                                                                    data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}" value="">
                                                                <div id="certificate_price_error"></div>
                                                                @if ($errors->has('certificate_price'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('certificate_price') }}
                                                                    </div>
                                                                @endif
                                                                <span
                                                                    class="help-block">{{ trans('cruds.course.fields.certificate_price_helper') }}</span>
                                                            </div> --}}

                {{-- <div class="form-group col-3">
                                                                <label class="required label-waves-effect required"
                                                                    style="position:relative; top:0;"
                                                                    for="has_credit_hours">{{ trans('cruds.course.fields.has_credit_hours') }}</label>
                                                                <i>*</i>
                                                                <select class="form-control select2"
                                                                    name="has_credit_hours" id="has_credit_hours"
                                                                    data-parsley-errors-container="#has_credit_hours_error"
                                                                    data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                                                                    onchange="getCreditHoursInput($(this).val())"
                                                                    style="display: block;">
                                                                    <option value="" disabled></option>
                                                                    <option value="has_credit">
                                                                        {{ trans('cruds.course.fields.has_credit') }}
                                                                    </option>
                                                                    <option value="no_credit">
                                                                        {{ trans('cruds.course.fields.no_credit') }}
                                                                    </option>
                                                                </select>
                                                                <div id="has_credit_hours_error"></div>
                                                            </div> --}}

                <div class="form-group col-6  accedit-hours-input">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="credit_hours">{{ trans('cruds.course.fields.credit_hours') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('credit_hours') ? 'is-invalid' : '' }}" type="number"
                        name="accredit_hours" id="credit_hours" data-parsley-errors-container="#credit_hours_error"
                        data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}" value="{{$course->accredit_hours}}">
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
                    <option value="" disabled></option>
                    @foreach ($lookups as $lookup)
                        @if ($lookup->type->slug == 'course_places')
                            <option value="{{ $lookup->slug }}" {{($lookup->id == $course->course_place_id) ? 'selected' : ''}}>
                                {{ $lookup->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div id="course_places_error"></div>
            </div>
            <div class="row col-12  place-hidden-section" style="display:none !important;">
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="country">{{ trans('cruds.course.fields.country') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="country_id" id="country_id"
                        data-parsley-errors-container="#country_error" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        onchange="getCities($(this).val())">
                        <option value="" disabled></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{($country->id == $course->country_id) ? 'selected' : ''}}>
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
                        <option value="" disabled></option>

                    </select>
                    <div id="city_error"></div>

                    <span class="help-block">{{ trans('cruds.course.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <input type="text" id="address" name="location" class="form-control" value="{{$course->location}}">
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
