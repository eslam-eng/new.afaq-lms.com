@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }}   {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.user.fields.date') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.user_name') }}

                        </th>
                        <th>
                            {{ trans('cruds.blogscomment.fields.phone_helper') }}
                        </th>
                        <th>
                            {{ trans('frontend.register.gender') }}
                        </th>
                        <th>
                            {{ trans('frontend.register.occupational_classification_number') }}
                        </th>

                        <th>
                            {{ trans('frontend.register.Field of your specialist study') }}
                        </th>
                        <th>
                            {{ trans('frontend.register.Field of your sub specialist study') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>


                        <th>
                            {{ trans('cruds.user.fields.join_course_date') }}
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>
{{--{{dd($courses->users->toArray())}}--}}
                <tbody>
                    @foreach($courses->users as $key => $user)
                    <tr data-entry-id="{{ $user->id }}">
                        <td></td>
                        <td>
                            {{ $user->id ?? '' }}
                        </td>
{{--                        <td>--}}
{{--                            {{ $user->created_at ?? '' }}--}}
{{--                        </td>--}}
                        <td>
                            {{app()->getLocale()=='en' ?$user->full_name_en: $user->full_name_ar}}

                        </td>
                        <td>
                            {{ $user->email ?? '' }}
                        </td>
                        <td>
                            {{ $user->user_name ?? '' }}
                        </td>
                        <td>
                            {{ $user->phone ?? '' }}
                        </td>



                        @if($user->gender == 'male')
                            <td>

                                {{app()->getLocale()=='ar'?'ذكر':'Male'}}
                            </td>
                        @else
                            <td>

                                {{app()->getLocale()=='ar'?'أنثي':'Female'}}
                            </td>
                        @endif




                        <td>
                            {{ $user->occupational_classification_number ?? '' }}
                        </td>


                        <td>

{{--                            {{ $speciality->name_en ?? '' }}--}}
                            {{app()->getLocale()=='en' ?$user->specialty->name_en ?? '': $user->specialty->name_ar ?? ''}}

                        </td>


                        <td>
                            {{app()->getLocale()=='en' ?$user->SubSpecialty->name_en ?? "": $user->SubSpecialty->name_ar ?? ""}}
                        </td>


                        <td>
                            <span style="display:none">{{ $user->verified ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                        <td>
                            {{ $user->created_at ?? '' }}
                        </td>
                        <td>

                            <a href="{{ route('admin.users.show', [$user->id , 'type' => request()->segment(2)]) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
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
