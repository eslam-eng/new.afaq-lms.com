@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.slider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <td>
                            {{ $slider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.title_en') }}
                        </th>
                        <td>
                            {{ $slider->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $slider->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.description_en') }}
                        </th>
                        <td>
                            {!! $slider->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $slider->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.link_en') }}
                        </th>
                        <td>
                            {{ $slider->link_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.link_ar') }}
                        </th>
                        <td>
                            {{ $slider->link_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.image') }}
                        </th>
                        <td>
                            @if($slider->image)
                                <a href="{{ $slider->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img style="width:300px;height:150px;" src="{{ $slider->image->getUrl() }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.image_ar') }}
                        </th>
                        <td>
                            @if($slider->image_ar)
                                <a href="{{ $slider->image_ar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $slider->image_ar->getUrl() }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.mobile_image_en') }}
                        </th>
                        <td>
                            @if($slider->mobile_image_en)
                                <a href="{{ $slider->mobile_image_en->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $slider->mobile_image_en->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.mobile_image_ar') }}
                        </th>
                        <td>
                            @if($slider->mobile_image_ar)
                                <a href="{{ $slider->mobile_image_ar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $slider->mobile_image_ar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.order') }}
                        </th>
                        <td>
                            {{ $slider->order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
