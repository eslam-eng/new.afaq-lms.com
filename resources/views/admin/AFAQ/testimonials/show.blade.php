@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testimonial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <td>
                            {{ $testimonial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.title') }}
                        </th>
                        <td>
                            {{ $testimonial->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.title_en') }}
                        </th>
                        <td>
                            {{ $testimonial->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.logo') }}
                        </th>
                        <td>
                            @if($testimonial->logo)
                                <a href="{{ $testimonial->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $testimonial->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.image') }}
                        </th>
                        <td>
                            @if($testimonial->image)
                                <a href="{{ $testimonial->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $testimonial->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.description') }}
                        </th>
                        <td>
                            {{ $testimonial->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.description_en') }}
                        </th>
                        <td>
                            {{ $testimonial->description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Testimonial::STATUS_RADIO[$testimonial->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
