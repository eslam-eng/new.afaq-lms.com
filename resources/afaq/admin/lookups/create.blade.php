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
            {{ trans('global.create') }} {{ $lookup_type->title }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.lookups.store', ['type_slug' => $type_slug]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name_en">{{ trans('cruds.lookup.fields.name_en') }}</label>
                    <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text"
                        name="title_en" id="name_en" value="{{ old('name_en', '') }}">
                    @if ($errors->has('name_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lookup.fields.name_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name_ar">{{ trans('cruds.lookup.fields.name_ar') }}</label>
                    <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text"
                        name="title_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                    @if ($errors->has('name_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lookup.fields.name_ar_helper') }}</span>
                </div>

                @if ($type_slug == 'course_classifications')
                    <div class="form-group">
                        <label class="label-waves-effect"
                            style="position:relative; top:0;">{{ trans('cruds.lookup.fields.parent_id') }}</label>

                        <select style="width: 100%;"
                            class="form-control select2 {{ $errors->has('parent_id') ? 'is-invalid' : '' }}"
                            name="parent_id" id="parent_id">
                            @foreach ($parent_lookups as $parent_lookup)
                                <option value=""></option>
                                <option value="{{ $parent_lookup->id }}">{{ $parent_lookup->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('parent_id') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.lookup.fields.parent_id_helper') }}</span>
                    </div>
                @endif

                <div class="form-group wrap-custom-file">
                    <label class="required" for="image">{{ trans('cruds.lookup.fields.image') }}</label>
                    <input type="file" value="{{ old('image', '') }}"name="image" id="image"
                        accept=".gif, .jpg, .png" />required
                    <label for="image">
                        <span>Image</span>
                        <i class="fa fa-plus-circle"></i>
                    </label>
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lookup.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label>{{ trans('cruds.testimonial.fields.status') }}</label>
                    @foreach(App\Models\Lookup::STATUS_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_{{ $key }}">{{ trans('cruds.testimonial.fields.'.$label)  }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.testimonial.fields.status_helper') }}</span>
                </div>

                <div class="form-group">
                    <label>{{ trans('cruds.specialty.fields.show_in_homepage') }}</label>
                    <select class="form-control {{ $errors->has('show_in_homepage') ? 'is-invalid' : '' }}" name="show_in_homepage" id="show_in_homepage">
                        <option value disabled {{ old('show_in_homepage', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Lookup::SHOW_IN_HOMEPAGE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('show_in_homepage', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.testimonial.fields.'.$label)  }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('show_in_homepage'))
                        <div class="invalid-feedback">
                            {{ $errors->first('show_in_homepage') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.testimonial.fields.status_helper') }}</span>
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
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.lookups.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                console.log(response);
                if (response.name) {
                    var t = tinyMCE.get(0);
                    var edObj = t.dom.getRoot();

                    //Set the Style "background-image" to the button's color value.
                    t.dom.setStyle(edObj, 'background-image', `url(${file.dataURL})`);
                    // t.dom.setStyle(edObj, 'background-image', `url(/lookupes/${response.name})`);
                    t.dom.setStyle(edObj, 'background-position', `center`);
                    t.dom.setStyle(edObj, 'background-size', `100% 100%`);
                    t.dom.setStyle(edObj, 'background-repeat', `no-repeat`);
                    t.dom.setStyle(edObj, 'height', `700px`);

                }
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($lookup) && $lookup->image)
                    var file = {!! json_encode($lookup->image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
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
    </script>
@endsection
