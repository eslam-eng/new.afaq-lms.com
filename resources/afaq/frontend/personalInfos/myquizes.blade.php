@extends('frontend.personalInfos.index')
@section('title' ,__('lms.my_quizes'))
@section('myprofile')
    <style>
        @media screen and (max-width: 830px) {
            .precemp {
                bottom: 30px;
            }


        }
        table,tr,td{
                text-align: center;
            }

    </style>
    <section class="mycourse-page-lms">
        <div class="container sit-container">
            <div class="all-courses">
                <div class="myprofile-page">

                    <div class="mycourse-page d-flex justify-content-between">
                        <div class=" myprofile-title">
                            <h3> {{ __('lms.my_quizes') }}</h3>
                        </div>

                    </div>
                    <!-- *************************************************************** -->
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
                                        <th scope="col">{{ __('lms.repeat_times') }}</th>
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
                                            <td>{{ $quizes_score->repeat_times }}</td>
                                            <td> {!!  $quizes_score->success ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>' !!}</td>
                                            <td>{{ $quizes_score->created_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @endif


                </div>
            </div>
        </div>
    </section>

@endsection
