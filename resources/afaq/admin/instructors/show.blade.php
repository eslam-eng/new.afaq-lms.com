@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instructor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructors.index') }}">
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
                            {{ $instructor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $instructor->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.name_en') }}
                        </th>
                        <td>
                            {{ $instructor->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.mail') }}
                        </th>
                        <td>
                            {{ $instructor->mail }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.mobile') }}
                        </th>
                        <td style="direction: rtl">
                            {{ $instructor->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.bio_ar') }}
                        </th>
                        <td>
                            {{ $instructor->bio_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.bio_en') }}
                        </th>
                        <td>
                            {{ $instructor->bio_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.image') }}
                        </th>
                        <td>
                            @if($instructor->image)
                                <a href="{{ $instructor->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $instructor->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.job_title') }}
                        </th>
                        <td>
                            {{ $instructor->job_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.workplace') }}
                        </th>
                        <td>
                            {{ $instructor->workplace }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.specialization') }}
                        </th>
                        <td>
{{--                            {{ $instructor->specialization->name_en ?? '' }}--}}
                            {{app()->getLocale()=='en' ? $instructor->specialization->name_en ?? '' : $instructor->specialization->name_ar ?? ''}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.twitter_account') }}
                        </th>
                        <td>
                            {{ $instructor->twitter_account }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.recent_work') }}
                        </th>
{{--                        {{dd($instructor->recent_work)}}--}}
                        @if($instructor->recent_work == 1)
                            <td>
                                {{ trans('lms.yes') }}
                            </td>
                        @else
                        <td>
                            {{ trans('lms.no') }}
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.resume') }}
                        </th>
                        <td>

                            @if($instructor->resume)

                                    <a class="btn btn-success waves-effect waves-light" href="{{ url('storage/'.$instructor->resume)  }}" download>Download here!</a>

{{--                                    {{ trans('global.view_file') }}--}}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Instructor::STATUS_RADIO[$instructor->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.order') }}
                        </th>
                        <td>
                            {{ $instructor->order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
