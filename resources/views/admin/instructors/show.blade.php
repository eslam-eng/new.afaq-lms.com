@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instructor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $instructor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $instructor->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.name_en') }}
                        </th>
                        <td>
                            {{ $instructor->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.mail') }}
                        </th>
                        <td>
                            {{ $instructor->mail }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.mobile') }}
                        </th>
                        <td>
                            {{ $instructor->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.bio_ar') }}
                        </th>
                        <td>
                            {{ $instructor->bio_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.bio_en') }}
                        </th>
                        <td>
                            {{ $instructor->bio_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instructor.fields.image') }}
                        </th>
                        <td>
                            @if($instructor->image)
                                <a href="{{ $instructor->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $instructor->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.order') }}
                        </th>
                        <td>
                            {{ $instructor->order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
