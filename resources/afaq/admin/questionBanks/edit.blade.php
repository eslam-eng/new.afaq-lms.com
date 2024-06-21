@extends('layouts.admin')
@section('content')
<style>
    .row-saved-data.remove {
        display: none;
    }
</style>
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.questionBank.question') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.question-banks.update", [$questionBank->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="exams_title_id">{{ trans('cruds.questionBank.fields.exam_title') }}</label>
                    <select class="form-control select2 {{ $errors->has('exam_title') ? 'is-invalid' : '' }}" name="exams_title_id" id="exams_title_id" required>
                        @foreach($exam_titles as $id => $entry)
                            <option value="{{ $id }}" {{ (old('exams_title_id') ? old('exams_title_id') : $questionBank->exam_title->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('exam_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('exam_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.questionBank.fields.exam_title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.questionBank.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $questionBank->title) }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.questionBank.fields.title_helper') }}</span>
                </div>
                <input type="hidden" value="{{count($questionBank->bank_answer->toArray())}}" id="count_answer">
                @if(count($questionBank->bank_answer->toArray()) > 0)
                    @foreach($questionBank->bank_answer as $key => $video)
                <div class="row-question-bank row-saved-data" >
                <div class="d-flex justify-content-start" id="inputFormRow">
                <div class="form-group">
                    <label class="required" for="answer">{{ trans('cruds.questionBank.fields.answer') }}</label>
                    <textarea rows="4" cols="100" class="form-control  {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer[]" id="answer" required>{{ old('answer', $video->answer) }}</textarea>
                    @if($errors->has('answer'))
                        <div class="invalid-feedback">
                            {{ $errors->first('answer') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.questionBank.fields.answer_helper') }}</span>
                </div>
                    <div style="width: 50px"></div>

                    <div class="form-group">


{{--                        <label class="required">{{ trans('cruds.questionBank.fields.correct_answer') }}</label>--}}
                        <div class="d-flex justify-content-start align-items-center">

                            {{--                                form-check-input--}}
                            <label class="required">{{ trans('cruds.questionBank.fields.Master') }}</label>  <div style="width: 15px"></div>:
                            <div style="width: 15px"></div>
                            <input type="radio" name="correct_answer" value="{{ $key }}" {{ $video->correct_answer ? 'checked' : '' }} required >
                            <div class="form-check {{ $errors->has('correct_answer') ? 'is-invalid' : '' }}">

                            </div>
                            @if($errors->has('correct_answer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('correct_answer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionBank.fields.correct_answer_helper') }}</span>
                        </div>

                    </div>
                    <div style="width: 100px"></div>
                    <button  type="button" class="remove-btn btn btn-danger col-4 col-md-2" id="removeRow"
                            style="height: max-content;">{{ trans('cruds.questionBank.fields.remove') }}</button>
                </div>

                </div>

                    @endforeach
                @endif
                <div id="newRow"></div>
                <div class="row-question-bank">



                    <div class="d-flex justify-content-end">
                        <div class="form-group">
                            <button id="addRow" type="button" class="btn btn-info mb-4">{{ trans('cruds.questionBank.fields.add_answer') }}</button>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
@section('scripts')
    <script>



        // add row
        $("#addRow").click(function() {
            var html = '';
            html += `<div class="input-group row mt-3" id="inputFormRow">
                   <div class="row-question-bank">
                   <div class="d-flex justify-content-start">
                       <div class="form-group">
                           <label class="required" for="answer">{{ trans('cruds.questionBank.fields.answer') }}</label>
                           <textarea id="answers0" rows="4" cols="100"  class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}"
                                     name="answer[]" id="answer[]" required>{{ old('answer') }}</textarea>
                           @if($errors->has('answer'))
            <div class="invalid-feedback">
{{ $errors->first('answer') }}
            </div>
@endif
            <span class="help-block">{{ trans('cruds.questionBank.fields.answer_helper') }}</span>
                       </div>
                       <div style="width: 50px"></div>
                       <div class="form-group">

                           {{--<label class="required">{{ trans('cruds.questionBank.fields.correct_answer') }}</label>--}}
                           <div class="d-flex justify-content-start">
                           <div class="d-flex justify-content-start align-items-center" >
                            <label class="required">{{ trans('cruds.questionBank.fields.Master') }}</label>
                            <div style="width: 15px"></div>:
                            <div style="width: 15px"></div>
                            <input type="radio" name="correct_answer" value="${parseInt($("#count_answer").val())}" ></div>

        </div>



        <span class="help-block">{{ trans('cruds.questionBank.fields.correct_answer_helper') }}</span>
                       </div>

                   </div>

               </div>
                    <div style="width: 100px"></div>
                    <button id="removeRow" type="button" class="btn btn-danger col-4 col-md-2"
                    style="height: max-content;">{{ trans('cruds.questionBank.fields.remove') }}</button>
                    </div>`;

            $('#newRow').append(html);
            $("#count_answer").val(parseInt($("#count_answer").val()) + 1);

        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
            $("#count_answer").val(parseInt($("#count_answer").val()) - 1);

        });





    </script>
@endsection
