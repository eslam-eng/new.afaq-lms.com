<h6>{{ trans('global.step') }} 5</h6>
<fieldset>
    <div class="row">
        <div class="col-12">
            <div class="row col-12">
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="start_date">{{ trans('cruds.course.fields.start_date') }}</label>
                    <i>*</i>
                    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="date"
                        name="start_date" id="start_date" value="{{ old('start_date') }}" required data-parsley-errors-container="#course_start_date" onchange="$('#end_date').attr('data-parsley-mindate',$(this).val())"  data-parsley-mindate="{{ date("m/d/Y", strtotime(now())) }}" data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                    @if ($errors->has('start_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </div>
                    @endif
                    <div id="course_start_date"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.start_date_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="end_date">{{ trans('cruds.course.fields.end_date') }}</label>
                    <i>*</i>
                    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="date"
                        name="end_date" id="end_date" value="{{ old('end_date') }}" required data-parsley-errors-container="#course_end_date"  data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                    @if ($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif
                    <div id="course_end_date"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.end_date_helper') }}</span>
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="start_register_date">{{ trans('cruds.course.fields.start_register_date') }}</label>
                    <i>*</i>
                    <input class="form-control date {{ $errors->has('start_register_date') ? 'is-invalid' : '' }}"
                        type="date" name="start_register_date" id="start_register_date"
                        value="{{ old('start_register_date') }}" required data-parsley-errors-container="#course_start_register_date" data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                    @if ($errors->has('start_register_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_register_date') }}
                        </div>
                    @endif
                    <div id="course_start_register_date"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.start_register_date_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="end_register_date">{{ trans('cruds.course.fields.end_register_date') }}</label>
                    <i>*</i>
                    <input class="form-control date {{ $errors->has('end_register_date') ? 'is-invalid' : '' }}"
                        type="date" name="end_register_date" id="end_register_date"
                        value="{{ old('end_register_date') }}" required data-parsley-errors-container="#course_end_register_date" data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                    @if ($errors->has('end_register_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_register_date') }}
                        </div>
                    @endif
                    <div id="course_end_register_date"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.end_register_date_helper') }}</span>
                </div>
            </div>
            <div class="row col-12">

                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;"
                        for="early_register_date">{{ trans('cruds.course.fields.early_register_date') }}</label>
                    <i>*</i>
                    <input class="form-control date {{ $errors->has('early_register_date') ? 'is-invalid' : '' }}"
                        type="date" name="early_register_date" id="early_register_date"
                        value="{{ old('early_register_date') }}" required data-parsley-errors-container="#course_early_register_date" data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                    @if ($errors->has('early_register_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('early_register_date') }}
                        </div>
                    @endif
                    <div id="course_early_register_date"></div>
                    <span class="help-block">{{ trans('cruds.course.fields.end_date_helper') }}</span>
                </div>
                <div class="form-group col-2">
                    <label for="has_general_price">{{ trans('cruds.course.fields.has_general_price') }}</label>
                    <input type="checkbox" data-parsley-group="step-5"  name="has_general_price" id="has_general_price" class="">
                </div>
                <div class="form-group col-4 price-field" style="display: none;">
                    <label class="required label-waves-effect" style="position:relative; top:0;" for="price">{{ trans('cruds.course.fields.price') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price','') }}" data-parsley-group="step-5" step="1" data-parsley-required-message="{{ trans('global.required') }}">
                    @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.price_helper') }}</span>
                </div>
                <div class="form-group col-2">
                    <label for="has_exclusive_mobile">{{ trans('cruds.course.fields.exclusive_mobile') }}</label>
                    <input type="checkbox" data-parsley-group="step-5"  name="has_exclusive_mobile" id="has_exclusive_mobile" class="" >
                </div>
                {{-- <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;" for="member_price">{{ trans('cruds.course.fields.member_price') }}</label>
                    <input class="form-control {{ $errors->has('member_price') ? 'is-invalid' : '' }}" type="number" name="member_price" id="member_price" value="{{ old('member_price','') }}" data-parsley-group="step-5" step="1">
                    @if($errors->has('member_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_price') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.price_helper') }}</span>
                </div> --}}
                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;" for="certificate_price">{{ trans('cruds.course.fields.certificate_price') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('certificate_price') ? 'is-invalid' : '' }}" type="number" name="certificate_price" data-parsley-group="step-5" id="certificate_price" value="{{ old('certificate_price', '') }}" step="1">
                    @if($errors->has('certificate_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificate_price') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.certificate_price_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label>{{ trans('cruds.course.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required data-parsley-errors-container="#course_status" data-parsley-group="step-5" data-parsley-required-message="{{ trans('global.required') }}">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Course::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ trans('cruds.course.fields.'.$label)  }}</option>
                        @endforeach
                    </select>
                    <div id="course_status"></div>
                    @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.status_helper') }}</span>
                </div>



                <div class="form-group col-6">
                    <label>{{ trans('cruds.course.fields.show_for_all') }}</label>
                    <select class="form-control {{ $errors->has('show_for_all') ? 'is-invalid' : '' }}" name="show_for_all" id="show_for_all"  data-parsley-errors-container="#course_show_for_all" data-parsley-group="step-5" >
                        <option value disabled {{ old('show_for_all', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Course::SHOW_FOR_ALL_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('show_for_all', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.course.fields.'.$label)  }}</option>
                        @endforeach
                    </select>
                    <div id="course_show_for_all"></div>
                    @if($errors->has('show_for_all'))
                        <div class="invalid-feedback">
                            {{ $errors->first('show_for_all') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.show_for_all_helper') }}</span>
                </div>



                <div class="form-group col-6">
                    <label class="required label-waves-effect" style="position:relative; top:0;" for="success_percentage">{{ trans('cruds.course.fields.success_percentage') }}</label>
                    <i>*</i>
                    <input class="form-control {{ $errors->has('success_percentage') ? 'is-invalid' : '' }}" type="number" name="success_percentage" data-parsley-group="step-5" id="success_percentage" value="{{ old('success_percentage', '') }}" step="1" required
                    data-parsley-required-message="{{ trans('global.required') }}">
                    @if($errors->has('success_percentage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('success_percentage') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.success_percentage_helper') }}</span>
                </div>
                <div class="form-group col-6">
                    <label class="label-waves-effect" style="position:relative; top:0;" for="certificate_id ">{{ trans('cruds.course.fields.certificate') }}</label>
                    <select class="form-control select2 {{ $errors->has('certificate') ? 'is-invalid' : '' }}" data-parsley-group="step-5" name="certificate_id[]" id="certificate_id">
                        @foreach($certificates as $cert)
                        <option value="{{ $cert->id }}" {{ old('certificate_id') == $cert->id ? 'selected' : '' }}>{{ $cert->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('certificate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificate') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.certificate_helper') }}</span>
                </div>
            </div>
        </div>
    </div>
</fieldset>
