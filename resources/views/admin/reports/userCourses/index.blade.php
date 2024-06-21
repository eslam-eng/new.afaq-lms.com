@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }}  {{ trans('cruds.user.title') }}
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
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.user.fields.user_name') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.blogscomment.fields.phone_helper') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('frontend.register.gender') }}--}}
{{--                        </th>--}}
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
                            {{ trans('cruds.user.fields.nationality') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.Action') }}
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $key => $user)
                    <tr data-entry-id="{{ $user->id }}">
                        <td></td>
                        <td>
                            {{ $user->id ?? '' }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ?$user->full_name_en: $user->full_name_ar}}
                        </td>
                        <td>
                            {{ $user->email ?? '' }}
                        </td>

                        <td>
                            {{ $user->phone ?? '' }}
                        </td>

                        <td>
                            {{ $user->occupational_classification_number ?? '' }}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $user->specialty->name_en ?? '': $user->specialty->name_ar ?? ''}}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ?$user->SubSpecialty->name_en ?? '': $user->SubSpecialty->name_ar ?? ''}}
                        </td>
                        <td>
                            {{app()->getLocale()=='en' ? $user->country_and_nationality->country_enName ?? '': $user->country_and_nationality->country_arName ?? ''}}
                        </td>
                        <td>
{{--                            {{app()->getLocale()=='en' ?$user->country_and_nationality->country_enNationality ?? '': $user->country_and_nationality->country_arNationality ?? ''}}--}}
                            {{ $user->city ?? '' }}

                        </td>
                        <td>
                            {{ $user->created_at ?? '' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.user-courses.show', [$user->id]) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                {{ trans('cruds.courseInvoice.fields.courses') }}
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
