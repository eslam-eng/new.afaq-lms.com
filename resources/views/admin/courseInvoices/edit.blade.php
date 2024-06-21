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
        {{ trans('global.edit') }} {{ trans('cruds.courseInvoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-invoices.update", [$courseInvoice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.courseInvoice.fields.users') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                <div class="invalid-feedback">
                    {{ $errors->first('user') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.users_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.courseInvoice.fields.courses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="courses_ids[]" id="course_id" required multiple>
                    @foreach($courses as $id => $entry)
                    <option value="{{ $id }}" {{ in_array($id, $courseInvoice->courses->pluck('course_id')->toArray())  ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                <div class="invalid-feedback">
                    {{ $errors->first('course') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.courses_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="invoice_id">{{ trans('cruds.courseInvoice.fields.invoice') }}</label>
                <input class="form-control {{ $errors->has('invoice_id') ? 'is-invalid' : '' }}" type="number" name="invoice_id" id="invoice_id" value="{{ old('invoice_id', $courseInvoice->invoice_id) }}" step="1" required>
                @if($errors->has('invoice_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('invoice_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.invoice_helper') }}</span>
            </div>
            {{-- <div class="form-group">--}}
            {{-- <label for="payment_method">{{ trans('cruds.courseInvoice.fields.payment_method') }}</label>--}}
            {{-- <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="number" name="payment_method" id="payment_method" value="{{ old('payment_method', $courseInvoice->payment_method) }}" step="1">--}}
            {{-- @if($errors->has('payment_method'))--}}
            {{-- <div class="invalid-feedback">--}}
            {{-- {{ $errors->first('payment_method') }}--}}
            {{-- </div>--}}
            {{-- @endif--}}
            {{-- <span class="help-block">{{ trans('cruds.courseInvoice.fields.payment_method_helper') }}</span>--}}
            {{-- </div>--}}
            <div class="form-group">
                <label class="required" for="payment_method_id">{{ trans('cruds.courseInvoice.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id" required>
                    @foreach($methods as $id => $entry)
                    <option value="{{ $entry->id }}" {{ old('payment_method_id') == $entry->id ? 'selected' : '' }}>{{ $entry->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                <div class="invalid-feedback">
                    {{ $errors->first('payment_method') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bank_id">{{ trans('cruds.courseInvoice.fields.bank') }}</label>
                <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id" id="bank_id" required>
                    @foreach($banks as $id => $entry)
                    <option value="{{ $id }}" {{ (old('bank_id') ? old('bank_id') : $courseInvoice->bank->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bank'))
                <div class="invalid-feedback">
                    {{ $errors->first('bank') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.courseInvoice.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $courseInvoice->amount) }}" step="0.01">
                @if($errors->has('amount'))
                <div class="invalid-feedback">
                    {{ $errors->first('amount') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency">{{ trans('cruds.courseInvoice.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', $courseInvoice->currency) }}">
                @if($errors->has('currency'))
                <div class="invalid-feedback">
                    {{ $errors->first('currency') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.courseInvoice.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $courseInvoice->date) }}">
                @if($errors->has('date'))
                <div class="invalid-feedback">
                    {{ $errors->first('date') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_name">{{ trans('cruds.courseInvoice.fields.bank_name') }}</label>
                <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $courseInvoice->bank_name) }}">
                @if($errors->has('bank_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('bank_name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_number">{{ trans('cruds.courseInvoice.fields.bank_number') }}</label>
                <input class="form-control {{ $errors->has('bank_number') ? 'is-invalid' : '' }}" type="text" name="bank_number" id="bank_number" value="{{ old('bank_number', $courseInvoice->bank_number) }}">
                @if($errors->has('bank_number'))
                <div class="invalid-feedback">
                    {{ $errors->first('bank_number') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_number_helper') }}</span>
            </div>

            <div class="form-group wrap-custom-file">
                <label class="required" for="invoice_image">{{ trans('cruds.courseInvoice.fields.invoice_image') }}</label>
                <input type="file" value="{{isset($courseInvoice->invoice_image) ? $courseInvoice->invoice_image->getUrl('thumb') : null}}" name="invoice_image" id="invoice_image" accept=".gif, .jpg, .png" />
                <label for="invoice_image">
                    <span>{{ trans('cruds.courseInvoice.fields.invoice_image') }} </span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('invoice_image'))
                <span class="text-danger">{{ $errors->first('invoice_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseInvoice.fields.invoice_image_helper') }}</span>
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
    @if("$courseInvoice->invoice_image")
    $(document).ready(function() {
        $('input[type="file"][name="invoice_image"]').each(function() {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            $label.addClass('file-ok').css('background-image', "url({{($courseInvoice->invoice_image->getUrl('thumb'))}} )");
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
