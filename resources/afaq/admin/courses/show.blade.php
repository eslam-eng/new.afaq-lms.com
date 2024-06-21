@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.course.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $course->id ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.classification') }}
                        </th>
                        <td>
                            {{ $course->courseClassification->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.sub_classifications') }}
                        </th>
                        <td>
                            {{ !empty($course->subClassifications) ? implode(collect($course->subClassifications)->pluck('title')->toArray(),','): '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.instructor') }}
                        </th>
                        <td>

                            {{ !empty($course->course_instructor)? implode(collect($course->course_instructor)->pluck('name')->toArray(),','): '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.name_en') }}
                        </th>
                        <td>
                            {{ $course->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $course->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.price') }}
                        </th>
                        <td>
                            {{ $course->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.image') }}
                        </th>
                        <td>
                            @if ($course->image)
                            <a href="{{ $course->image->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $course->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.start_date') }}
                        </th>
                        <td>
                            {{ $course->start_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.end_date') }}
                        </th>
                        <td>
                            {{ $course->end_date ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.introduction_to_course_en') }}
                        </th>
                        <td>
                            {!! $course->introduction_to_course_en ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.introduction_to_course_ar') }}
                        </th>
                        <td>
                            {!! $course->introduction_to_course_ar ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.certificate_price') }}
                        </th>
                        <td>
                            {{ $course->certificate_price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.accreditation_number') }}
                        </th>
                        <td>
                            {{ $course->accreditation_number ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.start_register_date') }}
                        </th>
                        <td>
                            {{ $course->start_register_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.end_register_date') }}
                        </th>
                        <td>
                            {{ $course->end_register_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.course_place') }}
                        </th>
                        <td>
                            {{$course->coursePlace->title ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.training_type') }}
                        </th>
                        <td>
                            {{ $course->courseTrack ? $course->courseTrack->title : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.description_en') }}

                        </th>
                        <td>
                            {!! $course->description_en ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $course->description_ar ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.lecture_hours') }}
                        </th>
                        <td>
                            {{ $course->lecture_hours ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.seating_number') }}
                        </th>
                        <td>
                            {{ $course->seating_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.zoom_link') }}
                        </th>
                        <td>
                            {{ $course->zoom_link ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.course.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Course::STATUS_SELECT[$course->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection