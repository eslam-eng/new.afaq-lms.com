<h6>{{ trans('global.step') }} 3</h6>
<fieldset>
    <div class="row">
        <div class="form-group col-6">
            <label class="required label-waves-effect" style="position:relative; top:0;"
                for="name_en">{{ trans('cruds.course.fields.name_en') }}</label>
            <i>*</i>
            <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en"
                id="name_en" value="{{ old('name_en', '') }}" required
                data-parsley-errors-container="#course_name_en" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"
                >
            @if ($errors->has('name_en'))
                <div class="invalid-feedback">
                    {{ $errors->first('name_en') }}
                </div>
            @endif
            <div id="course_name_en"></div>
            <span class="help-block">{{ trans('cruds.course.fields.name_en_helper') }}</span>
        </div>
        <div class="form-group col-6">
            <label class="required label-waves-effect" style="position:relative; top:0;"
                for="name_ar">{{ trans('cruds.course.fields.name_ar') }}</label>
            <i>*</i>
            <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar"
                id="name_ar" value="{{ old('name_ar', '') }}" required
                data-parsley-errors-container="#course_name_ar" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"
                >
            @if ($errors->has('name_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('name_ar') }}
                </div>
            @endif
            <div id="course_name_ar"></div>
            <span class="help-block">{{ trans('cruds.course.fields.name_ar_helper') }}</span>
        </div>
        <div class="form-group col-6">
            <label class="required label-waves-effect required" style="position:relative; top:0;"
                for="evaluation">{{ trans('cruds.course.fields.evaluation') }}</label>
            <i>*</i>
            <select class="form-control select2" name="evaluation" id="evaluation"
                data-parsley-errors-container="#evaluation_error" onchange="getAvailableEvaluation($(this).val())" data-parsley-group="step-1" style="display: block;">
                <option value="" disabled selected></option>
                <option value="available">
                    {{ trans('cruds.course.fields.available') }}
                </option>
                <option value="unavailable">
                    {{ trans('cruds.course.fields.unavailable') }}
                </option>
            </select>
            <div id="evaluation_error"></div>
        </div>
        <div class="form-group col-6 full-evaluation" style="display: none;">
            <label class=" label-waves-effect required" style="position:relative; top:0;"
                for="full_training_evaluation">{{ trans('cruds.course.fields.full_training_evaluation') }}</label>
            <i>*</i>
            <select class="form-control select2" name="full_training_evaluation" id="full_training_evaluation"
                data-parsley-errors-container="#full_training_evaluation_error" data-parsley-group="step-1" style="display: block;">
                <option value="" disabled selected></option>
                <option value="available">
                    {{ trans('cruds.course.fields.star_rating') }}
                </option>
                <option value="unavailable">
                    {{ trans('cruds.course.fields.text_stars') }}
                </option>
            </select>
            <div id="full_training_evaluation_error"></div>
        </div>

        <div class="row mx-0">
            <div class="form-group col-6">
                <label class="label-waves-effect" style="position:relative; top:0;" class=" "
                    for="requirements_en">{{ trans('cruds.course.fields.requirements_en') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor "
                    name="requirements_en" id="requirements_en" rows="3"
                    data-parsley-errors-container="#course_requirements_en" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}">
                    {{ old('requirements_en') }}</textarea>
                @if ($errors->has('requirements_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirements_en') }}
                    </div>
                @endif
                <div id="course_requirements_en"></div>
                <span class="help-block">{{ trans('cruds.course.fields.requirements_en_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required label-waves-effect" style="position:relative; top:0;"
                    for="requirements_ar">{{ trans('cruds.course.fields.requirements_ar') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor "
                    name="requirements_ar" id="requirements_ar" rows="3"
                    data-parsley-errors-container="#course_requirements_ar" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"
                    >{{ old('requirements_ar') }}</textarea>
                @if ($errors->has('requirements_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirements_ar') }}
                    </div>
                @endif
                <div id="course_requirements_ar"></div>
                <span class="help-block">{{ trans('cruds.course.fields.requirements_ar_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="label-waves-effect" style="position:relative; top:0;" class="required "
                    for="short_description_en">{{ trans('cruds.course.fields.short_description_en') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor {{ $errors->has('short_description_en') ? 'is-invalid' : '' }}"
                    name="introduction_to_course_en" id="short_description_en" rows="3" data-parsley-errors-container="#course_short_description_en" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}">{{ old('short_description_en') }}</textarea>
                @if ($errors->has('short_description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description_en') }}
                    </div>
                @endif
                <div id="course_short_description_en"></div>
                <span class="help-block">{{ trans('cruds.course.fields.short_description_en_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required label-waves-effect" style="position:relative; top:0;"
                    for="short_description_ar">{{ trans('cruds.course.fields.short_description_ar') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor {{ $errors->has('short_description_ar') ? 'is-invalid' : '' }}"
                    name="introduction_to_course_ar" id="short_description_ar" rows="3" data-parsley-errors-container="#course_short_description_ar" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}" >{{ old('short_description_ar') }}</textarea>
                @if ($errors->has('short_description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description_ar') }}
                    </div>
                @endif
                <div id="course_short_description_ar"></div>
                <span class="help-block">{{ trans('cruds.course.fields.short_description_ar_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="label-waves-effect" style="position:relative; top:0;" class="required "
                    for="description_en">{{ trans('cruds.course.fields.description_en') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"
                    id="description_en"
                    data-parsley-errors-container="#course_description_en" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"
                    >{{ old('description_en') }}</textarea>
                @if ($errors->has('description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_en') }}
                    </div>
                @endif
                <div id="course_description_en"></div>
                <span class="help-block">{{ trans('cruds.course.fields.description_en_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required label-waves-effect" style="position:relative; top:0;"
                    for="description_ar">{{ trans('cruds.course.fields.description_ar') }}</label>
                <i>*</i>
                <textarea class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar"
                    id="description_ar"
                    data-parsley-errors-container="#course_description_ar" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"
                    >{{ old('description_ar') }}</textarea>
                @if ($errors->has('description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_ar') }}
                    </div>
                @endif
                <div id="course_description_ar"></div>
                <span class="help-block">{{ trans('cruds.course.fields.description_ar_helper') }}</span>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group wrap-custom-file">
                <label class="required" for="image_en">{{ trans('cruds.course.fields.image_en') }}</label>
                <input type="file" value="{{ old('image_en', '') }}" name="image_en" id="image_en" required data-parsley-filemimetypes="image/jpeg, image/png" accept=".gif, .jpg, .png" data-parsley-filemimetypes="image/jpeg, image/png" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"  data-parsley-max-file-size="2000" data-parsley-errors-container="#course_image_en" />required
                <label for="image_en">
                    <span>Image EN</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('image_en'))
                <span class="text-danger">{{ $errors->first('image_en') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.image_en_helper') }}</span>
            </div>
            <div id="course_image_en"></div>
        </div>
        <div class="col-4">
            <div class="form-group wrap-custom-file">
                <label class="required" for="image_ar">{{ trans('cruds.course.fields.image_ar') }}</label>
                <input type="file" value="{{ old('image_ar', '') }}" name="image_ar" id="image_ar" required data-parsley-filemimetypes="image/jpeg, image/png" accept=".gif, .jpg, .png" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"  data-parsley-max-file-size="2000" data-parsley-errors-container="#course_image_ar"  />required
                <label for="image_ar">
                    <span>Image Ar</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('image_ar'))
                <span class="text-danger">{{ $errors->first('image_ar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.image_ar_helper') }}</span>
            </div>
            <div id="course_image_ar"></div>
        </div>
        <div class="col-4">
            <div class="form-group wrap-custom-file">
                <label class="required" for="video">{{ trans('cruds.course.fields.video') }}</label>
                <input type="file" value="{{ old('video', '') }}" name="video" id="video" data-parsley-filemimetypes="video/mp4" accept=".mp4" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"  data-parsley-max-file-size="6000" data-parsley-errors-container="#course_video" />required
                <label for="video">
                    <span>Video</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('video'))
                <span class="text-danger">{{ $errors->first('video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.video_helper') }}</span>
            </div>
            <div id="course_video"></div>
        </div>
        <div class="col-4">
            <div class="form-group wrap-custom-file">
                <label class="required" for="banner_en">{{ trans('cruds.course.fields.banner_en') }}</label>
                <input type="file" value="{{ old('banner_en', '') }}" name="banner_en" id="banner_en" required data-parsley-filemimetypes="image/jpeg, image/png" accept=".gif, .jpg, .png" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"  data-parsley-max-file-size="2000" data-parsley-errors-container="#course_banner_en" />required
                <label for="banner_en">
                    <span>Banner EN</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('banner_en'))
                <span class="text-danger">{{ $errors->first('banner_en') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.banner_en_helper') }}</span>
            </div>
            <div id="course_banner_en"></div>
        </div>
        <div class="col-4">
            <div class="form-group wrap-custom-file">
                <label class="required" for="banner_ar">{{ trans('cruds.course.fields.banner_ar') }}</label>
                <input type="file" value="{{ old('banner_ar', '') }}" name="banner_ar" id="banner_ar" required data-parsley-filemimetypes="image/jpeg, image/png" accept=".gif, .jpg, .png" data-parsley-group="step-3" data-parsley-required-message="{{ trans('global.required') }}"  data-parsley-max-file-size="2000" data-parsley-errors-container="#course_banner_ar" />required
                <label for="banner_ar">
                    <span>Banner Ar</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('banner_ar'))
                <span class="text-danger">{{ $errors->first('banner_ar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.banner_ar_helper') }}</span>
            </div>
            <div id="course_banner_ar"></div>
        </div>

    </div>
</fieldset>
