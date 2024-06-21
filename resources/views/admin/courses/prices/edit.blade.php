@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coursePrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="/admin/courses/{{$course_id}}/prices/update" enctype="multipart/form-data">
            @csrf
            @method('put')
            @foreach ($specialties as $index => $specialty)
                
                

                {{-- @if($early && $late) --}}

                <h3 class="text-center">{{ app()->getLocale()== "ar" ? $specialty->name_ar: $specialty->name_en }}</h3>
                <div class="row">
                    <input type="hidden" name="data[{{$index}}][specialty_id]" value="{{$prices[$specialty->id][0]->specialty_id ?? $specialty->id}}">
                    <input type="hidden" name="data[{{$index}}][course_id]" value="{{$prices[$specialty->id][0]->course_id ?? $course_id}}">
                    <div class="form-group col-6">
                        <label class="required" for="price">{{ trans('cruds.coursePrice.fields.early_price') }}</label>
                        <input class="form-control {{ $errors->has('data.*.price') ? 'is-invalid' : '' }}" type="number" name="data[{{$index}}][early_price]" id="price" value="{{ $prices[$specialty->id][0]->early_price ?? null }}" required>
                        @if($errors->has('data.*.early_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('data.*.early_price') }}
                            </div>
                        @endif
                        
                    </div>
                    <div class="form-group col-6">
                        <label class="required" for="price">{{ trans('cruds.coursePrice.fields.late_price') }}</label>
                        <input class="form-control {{ $errors->has('data.*.late_price') ? 'is-invalid' : '' }}" type="number" name="data[{{$index}}][late_price]" id="price" value="{{ $prices[$specialty->id][0]->late_price ?? null }}" required>
                        @if($errors->has('data.*.late_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('data.*.late_price') }}
                            </div>
                        @endif
                        
                    </div>
                    
                </div>

                <hr>

                {{-- @endif --}}
            @endforeach 
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection