@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-CourseCategory">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.instructor.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseCategory.fields.name_en') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseCategory.fields.name_ar') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseCategory.fields.rate') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseCategory.fields.review') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $d)
                            <tr data-entry-id="{{ $d->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $d->id ?? '' }}
                                </td>
                                <td>
                                    {{ $d->user->full_name_en ?? '' }}
                                </td>
                                <td>
                                    {{ $d->user->full_name_ar ?? '' }}
                                </td>
                                <td>
                                    {{ $d->rate ?? 0 }}
                                </td>
                                <td>
                                    {{ $d->review ?? '' }}
                                </td>
                                <td>
                                    @can('course_category_show')
                                        <a href="{{ route('admin.courses.course-questionaire.show.result', [$d->course_id, $d->user_id]) }}"
                                            type="button"
                                            class="btn btn-icon btn-icon  btn-primary waves-effect waves-float waves-light">
                                            questionaire result
                                        </a>
                                    @endcan

                                    <div class="custom-control custom-switch switch-lg custom-switch-success ml-2"
                                        style="margin-top: 7px;">
                                        <input type="checkbox" class="custom-control-input" id="status{{ $key }}"
                                            name="status" data-id="{{ $d->id }}"
                                            onchange="change_status({{ $d->id }} , {{ $d->user_id }} , 'status'+{{ $key }})"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-off="Un Publish" data-on="Publish" {{ $d->status == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status{{ $key }}">
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
        function change_status(id, user_id, el) {
            var status = $("#" + el).prop('checked') == true ? 1 : 0;

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/ChangeStatusReview',
                data: {
                    'status': status,
                    'id': id,
                    'user_id': user_id
                },
                success: function(data) {}
            });
        }
    </script>
@endsection
