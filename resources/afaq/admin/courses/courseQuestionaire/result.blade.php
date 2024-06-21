@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('lms.course_questionaire') }}
        </div>

        <div class="card-body">

            <div class="row">
                <div class="form-group col-6">
                    <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                    <input type="text" name="title_en" id="update_title_en" class="form-control" disabled
                        data-parsley-required-message="{{ trans('global.required') }}"
                        value="{{ $questionaire->title_en }}">
                </div>
                <div class="form-group col-5">
                    <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                    <input type="text" name="title_ar" id="update_title_ar" class="form-control" disabled
                        data-parsley-required-message="{{ trans('global.required') }}"
                        value="{{ $questionaire->title_ar }}">
                </div>
            </div>
            <div class="row col-12 justify-content-center mt-2">
                <div class="col-10">
                    <h3>{{ __('global.questions') }}</h3>
                </div>
            </div>
            <div class="repeater">
                <div class="row col-12 justify-content-center mb-5">
                    <div class="col-10">
                        <div data-repeater-list="questions" class="w-100">
                            @foreach ($questionaire->questions as $question)
                                <div data-repeater-item class="row w-100 border mb-1">
                                    <div class="form-group col-6">
                                        <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                        <input type="text" name="title_en" id="update_title_en" class="form-control"
                                            disabled required
                                            data-parsley-required-message="{{ trans('global.required') }}"
                                            value="{{ $question->title_en }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                        <input type="text" name="title_ar" id="update_title_ar" class="form-control"
                                            disabled required
                                            data-parsley-required-message="{{ trans('global.required') }}"
                                            value="{{ $question->title_ar }}">
                                    </div>

                                    <div class="row col-12 answars-div" id="answars-div-{{ $loop->index }}">
                                        <div class="row col-12 justify-content-center mt-1">
                                            <div class="col-10">
                                                <h3>{{ __('global.answer') }}</h3>
                                            </div>
                                        </div>
                                        @if ($question->answars->count() != 0)
                                            <div class="row col-12 justify-content-center mb-2 answars-div">
                                                <div class="col-10">
                                                    <!-- innner repeater -->
                                                    <div class="inner-repeater">
                                                        <div data-repeater-list="answars" class="w-100">
                                                            @foreach ($question->answars as $answar)
                                                                @php
                                                                    $result = $result->where('course_questionaire_question_id', $question->id)->first();
                                                                    $this_answer = $answar->id == $result->course_questionaire_question_answar_id ? true : false;
                                                                @endphp
                                                                <div data-repeater-item
                                                                    class="row border py-2 mt-1 mb-1 {{ $this_answer ? 'alert alert-success' : '' }}">
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                                                        <input type="text" name="title_en" disabled
                                                                            id="update_title_en" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}"
                                                                            value="{{ $answar->title_en ?? '' }}">
                                                                    </div>
                                                                    <div class="form-group col-5">
                                                                        <label
                                                                            for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                                                        <input type="text" name="title_ar" disabled
                                                                            id="update_title_ar" class="form-control"
                                                                            data-parsley-required-message="{{ trans('global.required') }}"
                                                                            value="{{ $answar->title_ar ?? '' }}">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row col-12 justify-content-center mb-2 answars-div">
                                                <div class="col-10">
                                                    <!-- innner repeater -->
                                                    <div class="inner-repeater">
                                                        <div data-repeater-list="answars" class="w-100">
                                                            @php
                                                                $result = $result->where('course_questionaire_question_id', $question->id)->first();
                                                            @endphp
{{--                                                            {{dd($result)}}--}}
                                                            <div class="row border py-2 mt-1 mb-1 alert alert-success">
                                                                <div class="form-group col-5">
                                                                    <textarea type="text" disabled id="update_title_en"
                                                                        class="form-control">{{ $result->answar_text ?? ''  }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
