@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-2 mt-2 w-100">
    @can('slider_create')
            <a class="btn btn-success slider-btn" href="{{ route('admin.sliders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.slider.title_singular') }}
            </a>
    @endcan
    <a class="btn btn-warning rate-btn" href="{{url('/admin/sliders/sorting')}}">{{ trans('cruds.slider.fields.sort') }} </a>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.slider.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Slider">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.title_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.title_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.link_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.link_ar') }}
                        </th>
                        {{-- <th>--}}
                        {{-- {{ trans('cruds.slider.fields.image') }}--}}
                        {{-- </th>--}}
                        <th>
                            {{ trans('cruds.slider.fields.image_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.mobile_image_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.order') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $key => $slider)
                    <tr data-entry-id="{{ $slider->id }}">
                        <td></td>
                        <td>
                            {{ $slider->id ?? '' }}
                        </td>
                        <td>
                            {{ $slider->title_en ?? '' }}
                        </td>
                        <td>
                            {{ $slider->title_ar ?? '' }}
                        </td>
                        <td>
                            {{Str::limit($slider->link_en, 50) ?? ''  }}
                        </td>
                        <td>

                            {{Str::limit($slider->link_ar, 50) ?? ''  }}
                        </td>

                        <td>
                            @if($slider->image_ar)
                            <a href="{{ $slider->image_ar->getUrl() }}" target="_blank" style="display: inline-block">
                                <img style="width:150px;height:100px;" src="{{ $slider->image_ar->getUrl() }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($slider->mobile_image_ar)
                            <a href="{{ $slider->mobile_image_ar->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $slider->mobile_image_ar->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $slider->order ?? '' }}
                        </td>
                        <td>
                            @can('slider_show')

                            <a href="{{ route('admin.sliders.show', $slider->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                    <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                </svg>
                            </a>
                            @endcan

                            @can('slider_edit')

                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>
                            @endcan

                            @can('slider_delete')

                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection