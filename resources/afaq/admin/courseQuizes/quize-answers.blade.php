@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.courseQuize.title') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.course-quizes.index',['course_id' =>  $courseQuize->course_id]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                @if (count($quizes_scores) > 0)
                <div class="Other_courses_lms ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('lms.course') }}</th>
                                <th scope="col">{{ __('cruds.courseQuize.title') }}</th>
                                <th scope="col">{{ __('cruds.courseQuize.fields.success_percentage') }}</th>
                                <th scope="col">{{ __('lms.score') }}</th>
                                <th scope="col">{{ __('cruds.user.title_singular') }}</th>
                                <th scope="col">{{ __('lms.success') }}</th>
                                <th scope="col">{{ __('lms.date') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizes_scores as $quizes_score)
                            {{-- class="{{ $quizes_score->success ? 'table-success' : 'table-danger' }}" --}}
                                <tr>
                                    <td scope="row">{{ $quizes_score->id }}</td>
                                    <td> {{ $quizes_score->course ? $quizes_score->course->name : '' }}</td>
                                    <td>{{ $quizes_score->quize ? $quizes_score->quize->name : '' }}</td>
                                    <td>{{ $quizes_score->quize ? $quizes_score->quize->success_percentage : '' }}
                                        %
                                    </td>
                                    <td>{{ $quizes_score->score_percentage }} %</td>
                                    <td>{{ $quizes_score->user ? (app()->getLocale() == 'en' ? $quizes_score->user->full_name_en : $quizes_score->user->full_name_ar) : '' }}</td>
                                    <td> {!!  $quizes_score->success ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>' !!}</td>
                                    <td>{{ $quizes_score->created_at }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            @endif
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.course-quizes.index',['course_id' =>  $courseQuize->course_id]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
