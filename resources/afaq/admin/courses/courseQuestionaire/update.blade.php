@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('lms.course_questionaire') }}
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('admin.courses.course-questionaire.update', ['course_questionaire' => $questionaire->id, 'course_id' => $course_id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="questionaire_id" value="{{ $questionaire->id }}">
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                        <input type="text" name="title_en" id="update_title_en" class="form-control" required
                            data-parsley-required-message="{{ trans('global.required') }}"
                            value="{{ $questionaire->title_en }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                        <input type="text" name="title_ar" id="update_title_ar" class="form-control" required
                            data-parsley-required-message="{{ trans('global.required') }}"
                            value="{{ $questionaire->title_ar }}">
                    </div>
                </div>
                <div class="row col-12 justify-content-center mt-5">
                    <div class="col-10">
                        <h3>{{ __('global.questions') }}</h3>
                    </div>
                </div>
                <div class="repeater">
                    <div class="row col-12 justify-content-center mb-5">
                        <div class="col-10">
                            <div data-repeater-list="questions" class="w-100">
                                @forelse ($questionaire->questions as $question)
                                    <div data-repeater-item class="row w-100 border mb-3">
                                        <div class="form-group col-6">
                                            <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                            <input type="text" name="title_en" id="update_title_en" class="form-control"
                                                required data-parsley-required-message="{{ trans('global.required') }}"
                                                value="{{ $question->title_en }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                            <input type="text" name="title_ar" id="update_title_ar" class="form-control"
                                                required data-parsley-required-message="{{ trans('global.required') }}"
                                                value="{{ $question->title_ar }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="type">{{ __('lms.type') }}</label>
                                            <select type="text" name="type" id="type"
                                                current-step="{{ $loop->index }}" class="form-control question-type"
                                                onchange="showAnswars(this)" required
                                                data-parsley-required-message="{{ trans('global.required') }}">
                                                {{-- <option value="" disabled selected>{{ __('lms.select') }}</option> --}}
                                                @foreach (['select', 'text', 'true_false'] as $type) {{--'multi_select',--}}
                                                    <option value="{{ $type }}"
                                                        {{ $question->type == $type ? 'selected' : '' }}>
                                                        {{ __('lms.' . $type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6" style="display: grid;">

                                            <label for="attachment">{{ __('global.attachment') }}</label>
                                            <input type="file" value="{{ old('attachment', '') }}" name="file"
                                                id="attachment"
                                                data-parsley-required-message="{{ trans('global.required') }}"
                                                data-parsley-errors-container="#course_attachment" />
                                            @if ($errors->has('attachment'))
                                                <span class="text-danger">{{ $errors->first('attachment') }}</span>
                                            @endif
                                            @if ($question->attachment)
                                                <a href="{{ $question->attachment ? $question->attachment->url : '#' }}"
                                                    target="_blank">{{ __('global.view_file') }}</a>
                                            @endif
                                            <div id="course_attachment"></div>
                                        </div>
                                        <div class="row col-12 answars-div" id="answars-div-{{ $loop->index }}"
                                            @if ($question->answars->count() == 0) style="display: none;" @endif>
                                            <div class="row col-12 justify-content-center mt-5">
                                                <div class="col-10">
                                                    <h3>{{ __('global.answer') }}</h3>
                                                </div>
                                            </div>
                                            <div class="row col-12 justify-content-center mb-5 answars-div">
                                                <div class="col-10">
                                                    <!-- innner repeater -->
                                                    <div class="inner-repeater">
                                                        <div data-repeater-list="answars" class="w-100">
                                                            @forelse ($question->answars as $answar)
                                                                <div data-repeater-item class="row border py-2 mt-1 mb-1">
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                                                        <input type="text" name="title_en"
                                                                            id="update_title_en" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}"
                                                                            value="{{ $answar->title_en }}">
                                                                    </div>
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                                                        <input type="text" name="title_ar"
                                                                            id="update_title_ar" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}"
                                                                            value="{{ $answar->title_ar }}">
                                                                    </div>
                                                                    <div class="form-group col-1">
                                                                        <label for=""class="w-100"></label>
                                                                        <button data-repeater-delete type="button"
                                                                            value="Delete"
                                                                            class="btn btn-danger  form-control px-0 w-50"><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div data-repeater-item class="row border py-2 mt-1 mb-1">
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                                                        <input type="text" name="title_en"
                                                                            id="update_title_en" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}">
                                                                    </div>
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                                                        <input type="text" name="title_ar"
                                                                            id="update_title_ar" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}">
                                                                    </div>
                                                                    <div class="form-group col-1">
                                                                        <label for=""class="w-100"></label>
                                                                        <button data-repeater-delete type="button"
                                                                            value="Delete"
                                                                            class="btn btn-danger  form-control px-0 w-50"><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                        <button data-repeater-create type="button" value="Add"
                                                            class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group col-12 d-flex flex-wrap justify-content-end">
                                            <div class="col-1">
                                                <label for=""class="w-100"></label>
                                                <button data-repeater-delete type="button" value="Delete"
                                                    class="btn btn-danger  form-control px-0 w-75"> {{ __('lms.Remove') }}
                                                    <i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                @empty
                                    <div data-repeater-item class="row w-100 border mb-3">

                                        <div class="form-group col-6">
                                            <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                            <input type="text" name="title_en" id="update_title_en"
                                                class="form-control" required
                                                data-parsley-required-message="{{ trans('global.required') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                            <input type="text" name="title_ar" id="update_title_ar"
                                                class="form-control" required
                                                data-parsley-required-message="{{ trans('global.required') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="type">{{ __('lms.type') }}</label>
                                            <select type="text" name="type" id="type" current-step="0"
                                                class="form-control question-type" onchange="showAnswars(this)" required
                                                data-parsley-required-message="{{ trans('global.required') }}">
                                                {{-- <option value="" disabled selected>{{ __('lms.select') }}</option> --}}
                                                @foreach (['multi_select', 'select', 'text', 'true_false'] as $type)
                                                    <option value="{{ $type }}">{{ __('lms.' . $type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6" style="display: grid;">

                                            <label for="attachment">{{ __('global.attachment') }}</label>
                                            <input type="file" value="{{ old('attachment', '') }}" name="file"
                                                id="attachment"
                                                data-parsley-required-message="{{ trans('global.required') }}"
                                                data-parsley-errors-container="#course_attachment" />
                                            @if ($errors->has('attachment'))
                                                <span class="text-danger">{{ $errors->first('attachment') }}</span>
                                            @endif

                                            <div id="course_attachment"></div>
                                        </div>
                                        <div class="row col-12 answars-div" id="answars-div-0" style="display: none;">
                                            <div class="row col-12 justify-content-center mt-5">
                                                <div class="col-10">
                                                    <h3>{{ __('global.answer') }}</h3>
                                                </div>
                                            </div>
                                            <div class="row col-12 justify-content-center mb-5 answars-div">
                                                <div class="col-10">
                                                    <!-- innner repeater -->
                                                    <div class="inner-repeater">
                                                        <div data-repeater-list="answars" class="w-100">
                                                            <div data-repeater-item class="row border py-2 mt-1 mb-1">
                                                                <div class="form-group col-5">
                                                                    <label
                                                                        for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                                                    <input type="text" name="title_en"
                                                                        id="update_title_en" class="form-control" required
                                                                        data-parsley-required-message="{{ trans('global.required') }}">
                                                                </div>
                                                                <div class="form-group col-5">
                                                                    <label
                                                                        for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                                                    <input type="text" name="title_ar"
                                                                        id="update_title_ar" class="form-control" required
                                                                        data-parsley-required-message="{{ trans('global.required') }}">
                                                                </div>
                                                                <div class="form-group col-1">
                                                                    <label for=""class="w-100"></label>
                                                                    <button data-repeater-delete type="button"
                                                                        value="Delete"
                                                                        class="btn btn-danger  form-control px-0 w-50"><i
                                                                            class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button data-repeater-create type="button" value="Add"
                                                            class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group col-12 d-flex flex-wrap justify-content-end">
                                            <div class="col-1">
                                                <label for=""class="w-100"></label>
                                                <button data-repeater-delete type="button" value="Delete"
                                                    class="btn btn-danger  form-control px-0 w-75"> {{ __('lms.Remove') }}
                                                    <i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                @endforelse
                            </div>
                            <button data-repeater-create type="button" value="Add" class="btn btn-primary">
                                {{ __('global.add') }}
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row border-top p-2">
                    <button class="btn btn-success"> {{ __('lms.Submit') }}</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/repeater.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.repeater').repeater({
                // (Required if there is a nested repeater)
                // Specify the configuration of the nested repeaters.
                // Nested configuration follows the same format as the base configuration,
                // supporting options "defaultValues", "show", "hide", etc.
                // Nested repeaters additionally require a "selector" field.
                repeaters: [{
                    // (Required)
                    // Specify the jQuery selector for this nested repeater
                    selector: '.inner-repeater'
                }],
                show: function() {
                    // Get items count
                    var items_count = $('.repeater').repeaterVal().questions.length;
                    var current_index = items_count - 1;
                    $(this).find('.answars-div').attr('id', 'answars-div-' + current_index);
                    $(this).find('.question-type').attr('current-step', current_index);

                    $(this).show();
                }
            });
        });
    </script>

    <script>
        function showAnswars(element) {
            var value = $(element).find(':selected').val();
            var controlled_div = $(element).attr('current-step');
            console.log();
            switch (value) {
                case 'multi_select':
                    $(`#answars-div-${controlled_div}`).show();
                    break;
                case 'select':
                    $(`#answars-div-${controlled_div}`).show();
                    break;
                default:
                    $(`#answars-div-${controlled_div}`).hide();
                    $(`#answars-div-${controlled_div}`).find('input[type="text"]').prop('required', false);
                    break;
            }
        }
    </script>
    @include('admin.courses.courseContent.loader')
@endsection
