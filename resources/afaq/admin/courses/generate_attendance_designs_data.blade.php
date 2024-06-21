@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.completion_percentage') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all as $key => $user_course)
                            @php $user = $user_course->user; @endphp
                            @if ($user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td></td>
                                    <td>
                                        {{ $user->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->created_at ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->completion_percentage ?? '' }}
                                    </td>
                                    <td>
                                        @php $item = \App\Models\UserAttendenceDesign::where(['user_id' => $user->id , 'course_id' => $user_course->course_id])->first(); @endphp
                                        @if (!$item)
                                            <a class="btn btn-xs btn-primary p-1 m-1"
                                                href='/admin/generate_attendance_designs/{{ $user_course->course_id }}/index?user_id={{ $user->id }}'>

                                                {{ trans('cruds.attendanceDesign.fields.generate_atten') }}
                                            </a>
                                        @else
                                            @if ($item && !$item->has_img)
                                                <img src="{{ $item->attendance_design_img }}" style='width:100px'>
                                            @else
                                              
                                                {{ trans('cruds.attendanceDesign.fields.done_atten') }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
