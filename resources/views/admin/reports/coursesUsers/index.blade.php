@extends('layouts.admin')
@section('content')
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.course.title') }}
    </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
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
                            {{ trans('cruds.user.fields.Action') }}&nbsp;
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

                                {{app()->getLocale()=='en' ? Str::limit($course->name_en, 50) : Str::limit($course->name_ar, 50)}}
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

                                <a href="{{ route('admin.course-users.show', $course->id) }}"
                                   type="button" class="btn btn-icon btn-icon rounded-circle btn-primary
                                    waves-effect waves-float waves-light">
                                    {{ trans('cruds.courseInvoice.fields.users') }}
                                </a>
                                <a href="{{ route('admin.course_invoice_report', $course->id) }}"
                                   type="button" class="btn btn-icon btn-icon rounded-circle btn-primary
                                    waves-effect waves-float waves-light">
                                    {{ trans('cruds.coursesUser.fields.invoices') }}
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

