@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sliderCard.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slider-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.id') }}
                        </th>
                        <td>
                            {{ $sliderCard->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.title_en') }}
                        </th>
                        <td>
                            {{ $sliderCard->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $sliderCard->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.description_en') }}
                        </th>
                        <td>
                            {!! $sliderCard->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $sliderCard->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderCard.fields.image') }}
                        </th>
                        <td>
                            @if($sliderCard->image)
                                <a href="{{ $sliderCard->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $sliderCard->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slider-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection