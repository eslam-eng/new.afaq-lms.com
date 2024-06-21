@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coursePrice.title_singular') }}
    </div>

    <div class="card-body">
        @if(count($specialties) > 0)
        <form method="POST" action="/admin/courses/{{$course_id}}/prices" enctype="multipart/form-data">
            @csrf

            @foreach ($specialties as $index => $specialty)

            <h3 class="text-center">{{ app()->getLocale()== "ar" ? $specialty->name_ar: $specialty->name_en }}</h3>

            <div class="row">
                <input type="hidden" name="data[{{$index}}][specialty_id]" value="{{$specialty->id}}">
                <input type="hidden" name="data[{{$index}}][course_id]" value="{{$course_id}}">
                <div class="form-group col-6">
                    <label class="required" for="price">{{ trans('cruds.coursePrice.fields.early_price') }}</label>
                    <input class="form-control {{ $errors->has('data.*.early_price') ? 'is-invalid' : '' }}" type="number" name="data[{{$index}}][early_price]" id="price" value="{{ old('early_price', '') }}" required>
                    @if($errors->has('data.*.early_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('early_price') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label class="required" for="price">{{ trans('cruds.coursePrice.fields.late_price') }}</label>
                    <input class="form-control {{ $errors->has('data.*.late_price') ? 'is-invalid' : '' }}" type="number" name="data[{{$index}}][late_price]" id="price" value="{{ old('late_price', '') }}" required>
                    @if($errors->has('data.*.late_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('late_price') }}
                    </div>
                    @endif

                </div>
            </div>
            <hr>
            @endforeach
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
        @else
        <h3 class="text-center">{{__('global.no_specialists')}}</h3>
        @endif
    </div>

</div>



@endsection