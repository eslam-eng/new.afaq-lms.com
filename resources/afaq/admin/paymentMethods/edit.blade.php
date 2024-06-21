@extends('layouts.admin')
@section('content')
<style>
    /*** CUSTOM FILE INPUT STYE ***/
    .wrap-custom-file {
        position: relative;
        display: inline-block;
        width: 150px;
        height: 150px;
        margin: 0 0.5rem 1rem;
        text-align: center;
    }

    .wrap-custom-file input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 2px;
        height: 2px;
        overflow: hidden;
        opacity: 0;
    }

    .wrap-custom-file label {
        z-index: 1;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        overflow: hidden;
        padding: 0 0.5rem;
        cursor: pointer;
        background-color: #fff;
        border-radius: 4px;
        -webkit-transition: -webkit-transform 0.4s;
        transition: -webkit-transform 0.4s;
        transition: transform 0.4s;
        transition: transform 0.4s, -webkit-transform 0.4s;
    }

    .wrap-custom-file label span {
        display: block;
        margin-top: 2rem;
        font-size: 1.4rem;
        color: #777;
        -webkit-transition: color 0.4s;
        transition: color 0.4s;
    }

    .wrap-custom-file label .fa {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        -webkit-transform: translatex(-50%);
        transform: translatex(-50%);
        font-size: 1.5rem;
        color: lightcoral;
        -webkit-transition: color 0.4s;
        transition: color 0.4s;
    }

    .wrap-custom-file label:hover {
        -webkit-transform: translateY(-1rem);
        transform: translateY(-1rem);
    }

    .wrap-custom-file label:hover span,
    .wrap-custom-file label:hover .fa {
        color: #333;
    }

    .wrap-custom-file label.file-ok {
        background-size: cover;
        background-position: center;
    }

    .wrap-custom-file label.file-ok span {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 0.3rem;
        font-size: 1.1rem;
        color: #000;
        background-color: rgba(255, 255, 255, 0.7);
    }

    .wrap-custom-file label.file-ok .fa {
        display: none;
    }
</style>
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentMethod.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-methods.update", [$paymentMethod->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.paymentMethod.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $paymentMethod->name_en) }}" required>
                @if($errors->has('name_en'))
                <div class="invalid-feedback">
                    {{ $errors->first('name_en') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_ar">{{ trans('cruds.paymentMethod.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $paymentMethod->name_ar) }}" required>
                @if($errors->has('name_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('name_ar') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.name_ar_helper') }}</span>
            </div>

{{--            <div class="form-group wrap-custom-file">--}}
{{--                <label class="required" for="provider_image">{{ trans('cruds.paymentMethod.fields.provider_image') }}</label>--}}
{{--                <input type="file" value="{{isset($paymentMethod->provider_image) ? $paymentMethod->provider_image : null}}" name="provider_image" id="provider_image" accept=".gif, .jpg, .png" />--}}
{{--                <label for="provider_image">--}}
{{--                    <span>{{ trans('cruds.paymentMethod.fields.provider_image') }} </span>--}}
{{--                    <i class="fa fa-plus-circle"></i>--}}
{{--                </label>--}}
{{--                @if($errors->has('provider_image'))--}}
{{--                <span class="text-danger">{{ $errors->first('provider_image') }}</span>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.user.fields.provider_image_helper') }}</span>--}}
{{--            </div>--}}


            <label class="required" for="local_image">{{ trans('cruds.paymentMethod.fields.local_image') }}</label>

            <div class="form-group wrap-custom-file">
                <label class="required" for="local_image">{{ trans('cruds.paymentMethod.fields.local_image') }}</label>
                <input type="file" value="{{$paymentMethod->local_image ? $paymentMethod->local_image->url : null}}" name="local_image" id="local_image" accept=".gif, .jpg, .png" />
                <label for="local_image">
                    <span>{{ trans('cruds.paymentMethod.fields.local_image') }} </span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('local_image'))
                    <span class="text-danger">{{ $errors->first('local_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.local_image_helper') }}</span>
            </div>




            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.provider') }}</label>
                <select class="form-control {{ $errors->has('provider') ? 'is-invalid' : '' }}" name="provider" id="provider">
                    <option value disabled {{ old('provider', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::PROVIDER_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('provider', $paymentMethod->provider) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('provider'))
                <div class="invalid-feedback">
                    {{ $errors->first('provider') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider_method_id">{{ trans('cruds.paymentMethod.fields.provider_method') }}</label>
                <input class="form-control {{ $errors->has('provider_method_id') ? 'is-invalid' : '' }}" type="number" name="provider_method_id" id="provider_method_id" value="{{ old('provider_method_id', $paymentMethod->provider_method_id) }}" step="1">
                @if($errors->has('provider_method_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('provider_method_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.provider_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_fees">{{ trans('cruds.paymentMethod.fields.service_fees') }}</label>
                <input class="form-control {{ $errors->has('service_fees') ? 'is-invalid' : '' }}" type="number" name="service_fees" id="service_fees" value="{{ old('service_fees', $paymentMethod->service_fees) }}" step="0.01">
                @if($errors->has('service_fees'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_fees') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.service_fees_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::TYPE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('type', $paymentMethod->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mode">{{ trans('cruds.paymentMethod.fields.mode') }}</label>
                <input class="form-control {{ $errors->has('mode') ? 'is-invalid' : '' }}" type="text" name="mode" id="mode" value="{{ old('mode', $paymentMethod->mode) }}">
                @if($errors->has('mode'))
                <div class="invalid-feedback">
                    {{ $errors->first('mode') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) == null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::STATUS_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('status', $paymentMethod->status) == (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>

    </div>
</div>



@endsection

@section('scripts')
<script type="text/javascript">
    @if("$paymentMethod->provider_image")
    $(document).ready(function() {
        $('input[type="file"][name="provider_image"]').each(function() {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            $label.addClass('file-ok').css('background-image', "url({{($paymentMethod->provider_image)}} )");
            $labelText.text('change image');
        });
    });
    @endif
    @if("$paymentMethod->local_image")
    $(document).ready(function() {
        $('input[type="file"][name="local_image"]').each(function() {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            $label.addClass('file-ok').css('background-image', "url({{($paymentMethod->local_image->getUrl('thumb'))}} )");
            $labelText.text('change image');
        });
    });
    @endif
    $('input[type="file"]').each(function() {
        // Refs
        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        // When a new file is selected
        $file.on('change', function(event) {
            var fileName = $file.val().split('\\').pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if (fileName) {
                $label
                    .addClass('file-ok')
                    .css('background-image', 'url(' + tmppath + ')');
                $labelText.text(fileName);
            } else {
                $label.removeClass('file-ok');
                $labelText.text(labelDefault);
            }
        });

        // End loop of file input elements
    });
</script>
@endsection
