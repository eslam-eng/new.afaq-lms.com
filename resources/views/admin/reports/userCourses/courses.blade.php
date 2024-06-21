@extends('layouts.admin')
@section('content')
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.course.title') }}
    </div>
<div class="card">


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                <thead>
                <tr>
                    <th></th>
                    <th style="width: 10px;">
                        {{trans('cruds.course.fields.id') }}
                    </th>

                    <th>
                        {{ trans('cruds.course.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.training_type') }}
                    </th>

                    <th>
                        {{ trans('cruds.course.fields.created_at') }}
                    </th>


                    <th>
                        {{ trans('cruds.course.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($userCourse->courses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td></td>
                        <td>
                            {{ $course->id ?? '' }}
                        </td>

                        <td>

                            {{app()->getLocale()=='en' ? Str::limit($course->name_en, 50) ?? ''  : Str::limit($course->name_ar, 50) ?? ''}}
                        </td>
                        <td>
                            {{ $course->price ?? '' }}
                        </td>
                        <td>
                            {{ $course->training_type ?? '' }}
                        </td>

                        <td>
                            {{ $course->created_at ?? '' }}
                        </td>


                        <td>
                            {{ App\Models\Course::STATUS_SELECT[$course->status] ?? '' }}
                        </td>
                        <td>

                            <a href="{{ route('admin.courses.show', $course->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                    <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
