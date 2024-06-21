@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.questionBank.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.question-banks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $questionBank->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questionBank.fields.exam_title') }}
                        </th>
                        <td>
                            {{ $questionBank->exam_title->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questionBank.fields.title') }}
                        </th>
                        <td>
                            {{ $questionBank->title }}
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.questionBank.fields.answer') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $questionBank->answer }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.questionBank.fields.correct_answer') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ App\Models\QuestionBank::CORRECT_ANSWER_RADIO[$questionBank->correct_answer] ?? '' }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.question-banks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
