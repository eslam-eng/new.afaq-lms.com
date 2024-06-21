@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.cancelationPolicy.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.cancelation-policies.update', [$cancelationPolicy->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="course_id">{{ trans('cruds.cancelationPolicy.fields.course') }}</label>
                    <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id"
                        id="course_id" required>
                        @foreach ($courses as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('course_id') ? old('course_id') : $cancelationPolicy->course->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course'))
                        <div class="invalid-feedback">
                            {{ $errors->first('course') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cancelationPolicy.fields.course_helper') }}</span>
                </div>
                <div class="repeater">
                    <div data-repeater-list="cancelation_policy_values">
                        @if (count($cancelationPolicy->cancelationValues))
                            @foreach ( $cancelationPolicy->cancelationValues as  $cancel_value)
                                <div data-repeater-item class="row">
                                    <div class="form-group col-5">
                                        <label for="days">{{ trans('cruds.cancelationPolicy.fields.days') }}</label>
                                        <input class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}"
                                            type="text" name="days" id="days" value="{{ old('days', $cancel_value->days) }}">
                                        @if ($errors->has('days'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('days') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.cancelationPolicy.fields.days_helper') }}</span>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="amount">{{ trans('cruds.cancelationPolicy.fields.amount') }}</label>
                                        <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                            type="number" name="amount" id="amount" value="{{ old('amount', $cancel_value->amount) }}"
                                            step="0.01">
                                        @if ($errors->has('amount'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('amount') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.cancelationPolicy.fields.amount_helper') }}</span>
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="repeater-delete"></label>
                                        <button id="repeater-delete" class="btn btn-danger form-control" data-repeater-delete
                                            type="button">{{ trans('global.delete') }} </button>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div data-repeater-item class="row">
                                <div class="form-group col-5">
                                    <label for="days">{{ trans('cruds.cancelationPolicy.fields.days') }}</label>
                                    <input class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}"
                                        type="text" name="days" id="days" value="{{ old('days', '') }}">
                                    @if ($errors->has('days'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('days') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.cancelationPolicy.fields.days_helper') }}</span>
                                </div>
                                <div class="form-group col-5">
                                    <label for="amount">{{ trans('cruds.cancelationPolicy.fields.amount') }}</label>
                                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        type="number" name="amount" id="amount" value="{{ old('amount', '') }}"
                                        step="0.01">
                                    @if ($errors->has('amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('amount') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.cancelationPolicy.fields.amount_helper') }}</span>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="repeater-delete"></label>
                                    <button id="repeater-delete" class="btn btn-danger form-control" data-repeater-delete
                                        type="button">{{ trans('global.delete') }} </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button id="repeater-add" data-repeater-create class="btn btn-primary form-control col-2 my-2"
                        type="button"> {{ trans('global.add') }} </button>
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
                }]
            });
        });
    </script>
@endsection
