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

        #mydiv {
            position: absolute;
            z-index: 9;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
        }

        #mydivheader {
            padding: 10px;
            cursor: move;
            z-index: 10;
            background-color: #2196F3;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/create_certificate.css')}}">
    <div class="card container" style="max-width: unset">
        <div class="row">
            <div class="card-image col-9">

                <div id="add_items_section">

                    <div class="d-flex flex-row tools_section">
                        <button type="button" class="add_text" onclick="Addtext()">Add Text</button>
                        <button type="button" id="remove">remove</button>
                        <!-- <button type="button" id="testttt">save</button> -->
                    </div>
                    <div class="form-group">
                        <select class="orange_info" id="placeholder">
                            <option>select text</option>
                            @foreach($keys as $key)
                                <option class="alert alert-warning m-1" > {{$key->key}} </span>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column tools_section justify-content-center">
                        <input type="file" id="new_image" accept=".gif, .jpg, .png">
                    </div>
                </div>
                <div id="certificate_image" style="display: none;">
                    <div id="boxx">
                        <!-- <canvas id="c" style="border:1px solid #000000"></canvas> -->
                        <canvas id="c" width="874" height="1240">
                    </div>
                </div>
                <div id="certificate_image_buttons" style="display: none;">
                    <div class="d-flex flex-row tools_section colors">
                        <div>
                            <label for="text-bg-color">Font color</label>
                            <input type="color" value="" id="text-color" size="10">
                        </div>
                        <div>
                            <label for="text-lines-bg-color">Background text color</label>
                            <input type="color" value="" id="text-lines-bg-color" size="10">
                        </div>
                        <div>
                            <label for="text-stroke-color">Stroke color</label>
                            <input type="color" value="" id="text-stroke-color">
                        </div>
                        <div>
                            <label for="text-bg-color">Background color</label>
                            <input type="color" value="" id="text-bg-color" size="10">
                        </div>

                    </div>

                    <div class="d-flex flex-row tools_section">

                        <div>
                            <!-- <label for="font-family" style="display:inline-block">Font family:</label> -->
                            <select id="font-family">
                                <option value="arial selected">Arial</option>
                                <option value="helvetica">Helvetica</option>
                                <option value="myriad pro">Myriad Pro</option>
                                <option value="delicious">Delicious</option>
                                <option value="verdana">Verdana</option>
                                <option value="georgia">Georgia</option>
                                <option value="courier">Courier</option>
                                <option value="comic sans ms">Comic Sans MS</option>
                                <option value="impact">Impact</option>
                                <option value="monaco">Monaco</option>
                                <option value="optima">Optima</option>
                                <option value="hoefler text">Hoefler Text</option>
                                <option value="plaster">Plaster</option>
                                <option value="engagement">Engagement</option>
                            </select>
                        </div>
                        <div>
                            <!-- <label for="text-align" style="display:inline-block">Text align:</label> -->
                            <select id="text-align">
                                <option value="left">
                                    &#xf036;
                                    <!-- <i class="fa-solid fa-align-left"></i> -->
                                </option>
                                <option value="center">
                                    &#xf037;
                                    <!-- <i class="fa-solid fa-align-center"></i> -->
                                </option>
                                <option value="right">
                                    &#xf038;
                                    <!-- <i class="fa-solid fa-align-right"></i> -->
                                </option>
                                <option value="justify">
                                    &#xf039;
                                    <!-- <i class="fa-solid fa-align-left"></i> -->
                                </option>
                            </select>
                        </div>

                        <!-- <div id="text-align" class="dropdown">
                                <div class="dropdown_items">
                                    <span value="left">
                                        Left
                                        <i class="fa-solid fa-align-left"></i>
                                    </span>
                                    <span value="center">
                                        Center
                                        <i class="fa-solid fa-align-center"></i>
                                    </span>
                                    <span value="right">
                                        Right
                                        <i class="fa-solid fa-align-right"></i>
                                    </span>
                                    <span value="justify">
                                        Justify
                                        <i class="fa-solid fa-align-left"></i>
                                    </span>
                                </div>
                            </div> -->
                    </div>

                    <div class="d-flex flex-row tools_section range_sction">
                        <div>
                            <label for="text-stroke-width">Stroke width:</label>
                            <input type="number" value="1" min="1" max="5" id="text-stroke-width">
                        </div>
                        <div>
                            <label for="text-font-size">Font size:</label>
                            <input type="number" value="1" min="1" max="120" step="1" id="text-font-size">
                        </div>
                        <div>
                            <label for="text-line-height">Line height:</label>
                            <input type="number" value="1" min="0" max="10" step="0.1" id="text-line-height">
                        </div>
                        <div>
                            Bold
                            <input type='checkbox' name='fonttype' id="text-cmd-bold">
                        </div>
                    </div>
                </div>

            </div>
    <div class="card-body col-3">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.attendanceDesign.title_singular') }}
        </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendance-designs.store") }}" enctype="multipart/form-data"  id="cert_form">
            @csrf
            <div class="form-group certificate_name">
                <label for="name_en">{{ trans('cruds.attendanceDesign.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}">
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceDesign.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group certificate_name">
                <label class="required" for="name_ar">{{ trans('cruds.attendanceDesign.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceDesign.fields.name_ar_helper') }}</span>
            </div>
            <div class="form-group wrap-custom-file add_image_button">
                <!-- <label class="required" for="image">{{ trans('cruds.attendanceDesign.fields.image') }}</label> -->
                <input type="file" value="{{ old('image', '') }}" name="image" id="image" accept=".gif, .jpg, .png" />
                <label class="image_text" for="image">
                    <span>Image</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceDesign.fields.image_helper') }}</span>
            </div>

{{--            <!-- <div class="form-group">--}}
{{--                    <label for="templete">{{ trans('cruds.certificat.fields.templete') }}</label>--}}
{{--                    <textarea class="form-control ckeditor {{ $errors->has('templete') ? 'is-invalid' : '' }}" name="templete" id="templete">{!! old('templete') !!}</textarea>--}}
{{--                    @if($errors->has('templete'))--}}
{{--                <div class="invalid-feedback">--}}
{{--{{ $errors->first('templete') }}--}}
{{--                </div>--}}



{{--@endif--}}
{{--            <span class="help-block">{{ trans('cruds.certificat.fields.templete_helper') }}</span>--}}
{{--                </div> -->--}}
            <input type="hidden" name="cert" id="cert">

            <div class="form-group">
                <button class="btn save_button" id="testttt" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection



@section('scripts')
    <script src="{{asset('fabric.min.js')}}"></script>
    <script src="{{asset('fab.js')}}"></script>

    <script type="text/javascript">
        $('input[type="file"]').each(function () {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            // When a new file is selected
            $file.on('change', function (event) {
                var fileName = $file.val().split('\\').pop(),
                    tmppath = URL.createObjectURL(event.target.files[0]);
                //Check successfully selection
                if (fileName) {
                    $label.addClass('file-ok').css('background-image', 'url(' + tmppath + ')');
                    $labelText.text(fileName);


                    if (tmppath) {
                        var t = tinyMCE.get(0);
                        var edObj = t.dom.getRoot();
                        t.dom.setStyle(edObj, 'background-image', `url(${tmppath})`);
                        t.dom.setStyle(edObj, 'background-position', `center`);
                        t.dom.setStyle(edObj, 'background-size', `100% 100%`);
                        t.dom.setStyle(edObj, 'background-repeat', `no-repeat`);
                        t.dom.setStyle(edObj, 'height', `700px`);
                    }
                } else {
                    $label.removeClass('file-ok');
                    $labelText.text(labelDefault);
                }
            });

            // End loop of file input elements
        });
    </script>
@endsection
