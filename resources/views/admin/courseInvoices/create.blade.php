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
            {{ trans('global.create') }} {{ trans('cruds.courseInvoice.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.course-invoices.store', ['locale' => app()->getLocale()]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.courseInvoice.fields.users') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id"
                        id="user_id" required>
                        @foreach ($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.users_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="course_id">{{ trans('cruds.courseInvoice.fields.courses') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}"
                        name="courses_ids[]" id="course_id" required>
                        @foreach ($courses as $id => $entry)
                            <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course'))
                        <div class="invalid-feedback">
                            {{ $errors->first('course') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.courses_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="payment_method_id">{{ trans('cruds.courseInvoice.fields.payment_method') }}</label>
                    <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}"
                        name="payment_method_id" id="payment_method_id" required onchange="change_payment_method()">
                        @foreach ($methods as $id => $entry)
                            <option value="{{ $entry->id }}"
                                {{ old('payment_method_id') == $entry->id ? 'selected' : '' }}
                                cash="{{ $entry->name_en == 'cash' || $entry->name_en == 'Cash' ? true : false }}"
                                free="{{ $entry->name_en == 'free' || $entry->name_en == 'Free' ? true : false }}">
                                {{ $entry->name_en }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('payment_method'))
                        <div class="invalid-feedback">
                            {{ $errors->first('payment_method') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.payment_method_helper') }}</span>
                </div>


                <div class="form-group">
                    <label for="amount" class="free">{{ trans('cruds.courseInvoice.fields.amount') }}</label>
                    <input class="form-control free {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number"
                        name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                    @if ($errors->has('amount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="currency" style="display: none">{{ trans('cruds.courseInvoice.fields.currency') }}</label>
                    <input value="SAR" class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}"
                        maxlength="5" type="hidden" name="currency" id="currency" value="{{ old('currency', '') }}">
                    @if ($errors->has('currency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.currency_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.courseInvoice.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                        name="date" id="date" value="{{ old('date') }}">
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.date_helper') }}</span>
                </div>

                <div class="form-group bank">
                    <label class="required" for="bank_id">{{ trans('cruds.courseInvoice.fields.bank') }}</label>
                    <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id"
                        id="bank_id" >
                        <option value="">اختر</option>
                        @foreach ($banks as $id => $entry)
                            <option value="{{ $id }}" {{ old('bank_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('bank'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bank') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_helper') }}</span>
                </div>
                <div class="form-group bank">
                    <label for="bank_name">{{ trans('cruds.courseInvoice.fields.bank_name') }}</label>
                    <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text"
                        name="bank_name" id="bank_name" value="{{ old('bank_name', '') }}">
                    @if ($errors->has('bank_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bank_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_name_helper') }}</span>
                </div>
                <div class="form-group bank">
                    <label for="bank_number">{{ trans('cruds.courseInvoice.fields.bank_number') }}</label>
                    <input class="form-control {{ $errors->has('bank_number') ? 'is-invalid' : '' }}" type="text"
                        name="bank_number" id="bank_number" value="{{ old('bank_number', '') }}">
                    @if ($errors->has('bank_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bank_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseInvoice.fields.bank_number_helper') }}</span>
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

        function change_payment_method() {
            let cash = $('#payment_method_id').find('option:selected').attr('cash');
            let free = $('#payment_method_id').find('option:selected').attr('free');

            if (cash || free) {
                $('.bank').hide();

                if (free) {
                    $('.free').hide();
                    $('#amount').val(0);
                }
            } else {
                $('.bank').show();
                $('.free').show();
                $('#amount').val('');

            }

        }
    </script>
@endsection
