<h6>{{ trans('global.step') }} 4</h6>
<fieldset>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="required label-waves-effect" style="position:relative; top:0;" for="lecture_hours">{{ trans('cruds.course.fields.lecture_hours') }}</label>
                <i>*</i>
                <input class="form-control {{ $errors->has('lecture_hours') ? 'is-invalid' : '' }}" type="number" name="lecture_hours" id="lecture_hours" value="{{ old('lecture_hours', $course->lecture_hours) }}" step="1" required data-parsley-errors-container="#course_lecture_hours" data-parsley-group="step-4" data-parsley-required-message="{{ trans('global.required') }}" >
                @if($errors->has('lecture_hours'))
                <div class="invalid-feedback">
                    {{ $errors->first('lecture_hours') }}
                </div>
                @endif
                <div id="course_lecture_hours"></div>
                <span class="help-block">{{ trans('cruds.course.fields.lecture_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required label-waves-effect" style="position:relative; top:0;" for="seating_number">{{ trans('cruds.course.fields.seating_number') }}</label>
              <i>{{ trans('cruds.course_messages.update_seat_number') }}{{$reservation_course}}</i>
                <input class="form-control {{ $errors->has('seating_number') ? 'is-invalid' : '' }}" type="number" min="{{$reservation_course}}" name="seating_number" id="seating_number" value="{{ old('seating_number', $course->seating_number) }}" step="1" required data-parsley-errors-container="#course_seating_number" data-parsley-group="step-4" data-parsley-required-message="{{ trans('global.required') }}">
                @if($errors->has('seating_number'))
                <div class="invalid-feedback">
                    {{ $errors->first('seating_number') }}
                </div>
                @endif
                <div id="course_seating_number"></div>
                <span class="help-block">{{ trans('cruds.course.fields.seating_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="label-waves-effect" style="position:relative; top:0;" for="target_group_id ">{{ trans('cruds.course.fields.target_group') }}</label>
                <!-- <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div> -->
                <select style="width: 100%;" onchange="get_sub_specialists()" class="form-control select2 {{ $errors->has('target_group') ? 'is-invalid' : '' }}" name="target_group_id[]" multiple id="target_group_id" required data-parsley-errors-container="#course_target_group_id" data-parsley-group="step-4" data-parsley-required-message="{{ trans('global.required') }}" >
                    @foreach($target_groups as $id => $entry)
                    <option value="{{ $id }}" {{ in_array( $id, $course_target_group_selected_array)  ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('target_group'))
                <div class="invalid-feedback">
                    {{ $errors->first('target_group') }}
                </div>
                @endif

                <div id="course_target_group_id"></div>
                <span class="help-block">{{ trans('cruds.course.fields.target_group_helper') }}</span>
            </div>
            <div id="show-me" class="form-group">
                <label class="label-waves-effect" style="position:relative; top:0;"
                       for="course_sub_specialty_id ">{{ trans('cruds.course.fields.course_sub_specialty') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('course_sub_specialty') ? 'is-invalid' : '' }}"
                        name="course_sub_specialty_id[]" id="course_sub_specialty_id" data-parsley-group="step-4" multiple>

                </select>
                @if ($errors->has('course_sub_specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course_sub_specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.course_sub_specialty_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label for="has_special_policy">{{ trans('cruds.course.fields.has_special_policy') }}</label>
                <input type="checkbox"  onclick="myPolicy()" data-parsley-group="step-4"  name="has_special_policy" id="has_special_policy" class="" {{ $course->has_special_policy ? 'checked' : '' }}>
            </div>
            <div class="row mx-0" id="mycheckboxdiv" @if(!$course->has_special_policy) style="display:none;" @endif>
            <div class="form-group col-6">
                <label class="label-waves-effect" style="position:relative; top:0;" class=" "
                       for="policy_en">{{ trans('cruds.course.fields.policy_en') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor "
                          name="policy_en" id="policy_en" rows="4"  data-parsley-errors-container="#course_policy_en" data-parsley-group="step-4" data-parsley-required-message="{{ trans('global.required') }}" >{{$course->policy_en}}</textarea>
                @if ($errors->has('policy_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('policy_en') }}
                    </div>
                @endif
                <div id="course_policy_en"></div>
                <span class="help-block">{{ trans('cruds.course.fields.policy_en_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required label-waves-effect" style="position:relative; top:0;"
                       for="policy_ar">{{ trans('cruds.course.fields.policy_ar') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor {{ $errors->has('policy_ar') ? 'is-invalid' : '' }}"
                          name="policy_ar" id="policy_ar" rows="4" data-parsley-errors-container="#course_policy_ar" data-parsley-group="step-4" data-parsley-required-message="{{ trans('global.required') }}">{{$course->policy_ar}}</textarea>
                @if ($errors->has('policy_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('policy_ar') }}
                    </div>
                @endif
                <div id="course_policy_ar"></div>
                <span class="help-block">{{ trans('cruds.course.fields.policy_ar_helper') }}</span>
            </div>
            </div>

        </div>
    </div>
</fieldset>
