@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cancelationPolicy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancelation-policies.index') }}">
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
                            {{ $cancelationPolicy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cancelationPolicy.fields.course') }}
                        </th>
                        <td>
                            {{ $cancelationPolicy->course->name_en ?? '' }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>
                        {{ trans('cruds.cancelationPolicy.fields.days') }}
                    </th>
                    <th>
                        {{ trans('cruds.cancelationPolicy.fields.amount') }}
                    </th>
                </thead>
                <tbody>
                    @foreach ($cancelationPolicy->cancelationValues as $cancelation_value)
                    <tr>
                        <td>
                            {{ $cancelation_value->days }}
                        </td>
                        <td>
                            {{ $cancelation_value->amount }}
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cancelation-policies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
