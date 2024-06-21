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
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.id') }}
                        </th>
                        <td>
                            {{ $courseQuize->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.course') }}
                        </th>
                        <td>
                            {{ $courseQuize->course->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.exam_title') }}
                        </th>
                        <td>
                            {{ $courseQuize->exam_title->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.title_en') }}
                        </th>
                        <td>
                            {{ $courseQuize->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $courseQuize->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.description_en') }}
                        </th>
                        <td>
                            {{ $courseQuize->description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.description_ar') }}
                        </th>
                        <td>
                            {{ $courseQuize->description_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.tips_guidelines') }}
                        </th>
                        <td>
                            {{ $courseQuize->tips_guidelines }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.success_percentage') }}
                        </th>
                        <td>
                            {{ $courseQuize->success_percentage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.image') }}
                        </th>
                        <td>
                            @if($courseQuize->image)
                                <a href="{{ $courseQuize->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $courseQuize->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.start_at') }}
                        </th>
                        <td>
                            {{ $courseQuize->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.end_at') }}
                        </th>
                        <td>
                            {{ $courseQuize->end_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseQuize.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CourseQuize::STATUS_RADIO[$courseQuize->status] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.course-quizes.index',['course_id' =>  $courseQuize->course_id]) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
