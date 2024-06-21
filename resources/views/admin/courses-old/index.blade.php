@extends('layouts.admin')
@section('content')
@can('course_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.courses.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.course.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="pr-2 pl-2 pt-2">
        <form method="get" action="{{ route('admin.courses.index') }}">
            <div class="row">

                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="users-list-role">{{ trans('cruds.courseCategory.title_singular') }}</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-role" name="category_id">
                            <option value="">All</option>
                            @foreach($courseCategories as $item)
                            <option {{$item->id == request('category_id') ? 'selected' : ''}} value="{{$item->id}}">{{app()->getLocale() == 'en' ? $item->name_en : $item->name_ar}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="users-list-status">{{ trans('cruds.specialty.title_singular') }}</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-status" name="specialty_id">
                            <option value="">All</option>
                            @foreach($specialties as $item)
                            <option {{$item->id == request('specialty_id') ? 'selected' : ''}} value="{{$item->id}}">{{app()->getLocale() == 'en' ? $item->name_en : $item->name_ar}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="users-list-verified">{{ trans('cruds.subSpecialty.title_singular') }}</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-verified" name="sub_specialty_id">
                            <option value="">All</option>
                            @foreach($subSpecialties as $item)
                            <option {{$item->id == request('sub_specialty_id') ? 'selected' : ''}} value="{{$item->id}}">{{app()->getLocale() == 'en' ? $item->name_en : $item->name_ar}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-1">
                    <button class="btn btn-xs btn-primary text-right mt-2" type="submit">
                        filter
                    </button>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    @can('course_category_show')
                    <a class="btn btn-xs btn-warning text-right mt-2" style="width: max-content" href="{{ route('admin.course-cources.sync') }}">
                    {{ trans('cruds.course.fields.sync') }}
                    </a>
                    @endcan
                </div>

                <div class="col-12 col-sm-6 col-lg-2">
                    @can('course_configration_access')
                    <a href="{{ route('admin.course-configrations.index') }}" style="width: max-content;background-color: #9AA9B7 ;color: white;" class="btn btn-xs text-right mt-2" {{ request()->is("admin/course-configrations") || request()->is("admin/course-configrations/*") ? "c-active" : "" }}">
                        {{ trans('cruds.courseConfigration.title') }}
                    </a>
                    @endcan
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: 10px;">
                            {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th style="width: 50px;">
                            {{ trans('cruds.course.fields.category') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.course.fields.instructor') }}
                        </th>
                        --}}
                        <th>
                            {{ trans('cruds.course.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.end_date') }}
                        </th>
                        {{--
                        <th style="width: 20px;">
                            {{ trans('cruds.course.fields.show_in_homepage') }}
                        </th>
                        --}}

                        <th>
                            {{ trans('cruds.course.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td></td>
                        <td>
                            {{ $course->id ?? '' }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $course->category->name_en ?? '' : $course->category->name_ar ?? ''}}
                        </td>
                        {{--
                        <td>
                            {{ json_encode($course->course_instructor->pluck('name'), JSON_UNESCAPED_UNICODE)}}
                        </td>
                        --}}
                        <td>
                            {{app()->getLocale()=='en' ? substr($course->name_en,0,60).'...' ?? '' : substr($course->name_ar,0,60).'...' ?? ''}}
                        </td>
                        <td>
                            {{ $course->price ?? '' }}
                        </td>
                        <td>
                            @if($course->image)
                            <a href="{{ $course->image->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $course->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $course->start_date ?? '' }}
                        </td>
                        <td>
                            {{ $course->end_date ?? '' }}
                        </td>
                        {{--
                        <td>
                            {{ $course->show_in_homepage ?? '' }}
                        </td>
                        --}}
                        <td>
                            {{ App\Models\Course::STATUS_SELECT[$course->status] ?? '' }}
                        </td>
                        <td>
                            @can('course_show')
                            <a href="{{ route('admin.courses.show', $course->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                    <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                </svg>
                            </a>
                            @endcan

                            @can('course_edit')
                            <a href="{{ route('admin.courses.edit', $course->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>
                            @endcan

                            @can('course_delete')
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </form>
                            @endcan

                            <a class="btn btn-xs {{ count($course->prices) > 0 ? 'btn-success' : 'btn-info' }} courses_admin_buttons" href='/admin/courses/{{$course->id}}/prices/edit'>
                                <!-- {{ trans('prices')}} -->
                                <i class="feather icon-dollar-sign"></i>
                            </a>
                            <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">
                                <input type="checkbox" class="custom-control-input" id="status{{$key}}" name="status" data-id="{{$course->id}}" onchange="change_status({{$course->id}} , 'status'+{{$key}})" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="Un Publish" data-on="Publish" {{$course->status == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status{{$key}}">
                                    <span class="switch-text-right">Un Published</span>
                                    <span class="switch-text-left">Published</span>
                                </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>
    function change_status(course_id, el) {
        var status = $("#" + el).prop('checked') == true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/ChangeStatusCourse',
            data: {
                'status': status,
                'course_id': course_id
            },
            success: function(data) {}
        });
    }
</script>
@endsection