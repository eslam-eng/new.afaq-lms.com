@extends('layouts.admin')
@section('content')
@can('course_category_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.course-categories.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.courseCategory.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.courseCategory.title_singular') }} 

        @can('course_category_show')
        <a class="btn btn-xs btn-warning text-right" style="float: right;" href="{{ route('admin.course-categories.sync') }}">
            Sync Moodle Categories
        </a>
        @endcan

    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CourseCategory">
                <thead>
                    <tr>
<th></th>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCategory.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCategory.fields.name_ar') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseCategories as $key => $courseCategory)
                    <tr data-entry-id="{{ $courseCategory->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $courseCategory->id ?? '' }}
                        </td>
                        <td>
                            {{ $courseCategory->name_en ?? '' }}
                        </td>
                        <td>
                            {{ $courseCategory->name_ar ?? '' }}
                        </td>
                        <td>
                            @can('course_category_show')

                                <a href="{{ route('admin.course-categories.show', $courseCategory->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                        <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                    </svg>
                                </a>
                            @endcan

                            @can('course_category_edit')

                                    <a href="{{ route('admin.course-categories.edit', $courseCategory->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>
                            @endcan

                            @can('course_category_delete')

                                    <form action="{{ route('admin.course-categories.destroy', $courseCategory->id) }}"
                                          method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit"
                                                class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-trash me-50">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                            @endcan
                                <div class="custom-control custom-switch switch-lg custom-switch-success ml-2" style="margin-top: 7px;">
                                    <input type="checkbox" class="custom-control-input" id="featured{{$key}}"
                                           name="featured" data-id="{{$courseCategory->id}}"
                                           onchange="change_featured({{$courseCategory->id}} , 'featured'+{{$key}})"
                                           data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                           data-off="Un Featured"
                                           data-on="Featured" {{$courseCategory->featured == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="featured{{$key}}">
                                        <span class="switch-text-right">Un Featured</span>
                                        <span class="switch-text-left">Featured</span>
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
        function change_featured(course_category_id, el) {
            var featured = $("#" + el).prop('checked') == true ? 1 : 0;

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/ChangeFeature',
                data: {
                    'featured': featured,
                    'course_category_id': course_category_id
                },
                success: function(data) {}
            });
        }
    </script>
@endsection
