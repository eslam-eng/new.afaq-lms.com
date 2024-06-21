    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/app-assets/js/scripts/forms/wizard-steps.js') }}"></script>
   <script src="https://cdn.tiny.cloud/1/xdtvumic5spz8s20xfmw404uqqibaqka8var52dipy3hxwag/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.ckeditor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 300,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            valid_elements: '*[*]',
            extended_valid_elements: "style,link[href|rel]",
            custom_elements: "style,link,~link"
        });
    </script>
    <!-- END: Page JS-->
    <script>
        // Wizard tabs with numbers setup
        $(".number-tab-steps").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish:"{{ __('global.submit') }}",// 'Submit',
                next: "{{ __('pagination.next') }}",
                previous: "{{ __('pagination.previous') }}"
            },
            onFinished: function(event, currentIndex) {
                if ($(this).parsley().isValid(`step-${currentIndex + 1}`)) {
                    var frm = $('#course_form');
                    var url = frm.attr('action');

                    var formData = new FormData();
                    formData.append('_token', $('input[name="_token"]').val());
                    formData.append('_method', 'PUT');
                    formData.append('step',currentIndex + 1);
                    $(`[data-parsley-group="step-${currentIndex + 1}"]`).each(function(i, input) {
                        if (input.type == 'checkbox') {
                            if (input.checked) {
                                formData.append(input.name, input.value);
                            }
                        } else if (input.type == 'textarea') {
                            formData.append(input.name, tinymce.get(input.id).getContent());
                        } else if (input.multiple) {
                            var values = [];
                            $(`#${input.id} :selected`).each(function(i, selected) {
                                formData.append(input.name.replace('[]', `[${i}]`), $(selected)
                                    .val());
                            });
                        } else {
                            formData.append(input.name, input.value);
                        }
                    });

                    $.ajax({
                        type: frm.attr('method'),
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var update_url = "{{ route('admin.courses.update', 'id:id') }}"
                            update_url = update_url.replace('id:id', [response.id]);
                            console.log(update_url);
                            $('#course_form').attr('action', update_url);
                            $('#course_form').append(
                                '<input type="hidden" name="_method" value="PUT"/>');
                            window.location.href = "{{ route('admin.courses.index') }}"
                        }
                    });
                    return true;
                } else {
                    $(this).parsley().validate(`step-${currentIndex + 1}`);
                }
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex < newIndex) {
                    if ($(this).parsley().isValid(`step-${currentIndex + 1}`)) {
                        var frm = $('#course_form');
                        var url = frm.attr('action');

                        var formData = new FormData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('_method', 'PUT');
                        formData.append('step',currentIndex + 1);
                        $(`[data-parsley-group="step-${currentIndex + 1}"]`).each(function(i, input) {
                            if (input.type == 'checkbox') {
                                if (input.checked) {
                                    formData.append(input.name, input.value);
                                }
                            } else if (input.type == 'textarea') {
                                formData.append(input.name, tinymce.get(input.id).getContent());
                            } else if (input.multiple) {
                                $(`#${input.id} :selected`).each(function(i, selected) {
                                    formData.append(input.name.replace('[]',`[${i}]`), $(selected).val());
                                });
                            }else {
                                formData.append(input.name, input.value);
                            }
                        });


                        if (currentIndex == 2) {
                            formData.append('image_en', $('input[name="image_en"]')[0].files[0]);
                            formData.append('image_ar', $('input[name="image_ar"]')[0].files[0]);
                            formData.append('banner_en', $('input[name="banner_en"]')[0].files[0]);
                            formData.append('banner_ar', $('input[name="banner_ar"]')[0].files[0]);
                            formData.append('video', $('input[name="video"]')[0].files[0]);
                        }

                        $.ajax({
                            type: frm.attr('method'),
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                var update_url = "{{ route('admin.courses.update', 'id:id') }}"
                                update_url = update_url.replace('id:id', [response.id]);
                                console.log(update_url);
                                $('#course_form').attr('action', update_url);
                                $('#course_form').append(
                                    '<input type="hidden" name="_method" value="PUT"/>')
                            }
                        });
                        return true;
                    } else {
                        $(this).parsley().validate(`step-${currentIndex + 1}`);
                    }
                } else {
                    return true;
                }
            }
        });
    </script>
    <script src="{{ asset('/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/forms/form-select2.min.js') }}"></script>

    <script>
        $('.select-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })
        $(".select2").select2();
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSLrOStHNOxyKZ3KYvmJzWDuvDU866Z9M&libraries=geometry,places&callback=initMap">
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
    <script>
        function showPlaceSection(value) {
            if (value == 'physical-training' || (value == 'broadcast-attendance')) {
                $('.place-hidden-section').show();
                $('#attendance_design_id').prop('required', true);
                $('#country_id').prop('required', true);
                $('#city_id').prop('required', true);
                $('#lat').prop('required', true);
                $('#lng').prop('required', true);
            } else {
                $('.place-hidden-section').hide();
                $('#attendance_design_id').prop('required', false);
                $('#country_id').prop('required', false);
                $('#city_id').prop('required', false);
                $('#lat').prop('required', false);
                $('#lng').prop('required', false);
            }
        }

        function getSubClassifications(value, selected = null) {
            let lookups = @json($lookups);

            let sub_classifications = lookups.filter(function(lookup) {
                return (lookup.type.slug == 'course_classifications') && (lookup.parent_id == value);
            });
            if (sub_classifications.length) {
                $('#course_sub_classification_id').empty();
                console.log(selected);
                $.each(sub_classifications, function(index, sub) {
                    $('#course_sub_classification_id').append(
                        `<option value="${sub.id}" ${(selected.includes(sub.id)) ? 'selected' : ''}>${sub.name}</option>`
                    )
                });
                $('#course_sub_classification_id').select2('destroy');
                $('#course_sub_classification_id').select2();
            } else {
                // $('#course_sub_classification_id').select2('destroy');
                $('#course_sub_classification_id').empty();

            }
        }

        function getTimeInputs(value) {
            if (value == 'anticipated') {
                $('.anticipated_date').show();
                $('#anticipated_date').prop('required', true);
            } else {
                $('.anticipated_date').hide();
                $('#anticipated_date').prop('required', false);
            }
        }

        function getAccrediteInputs(value) {
            if (value == 'accredited') {
                $('.accreditation-hidden-section').show();
                $('#certificate_number').prop('required', true);
                $('#credit_hours').prop('required', true);
            } else {
                $('.accreditation-hidden-section').hide();
                $('#certificate_number').prop('required', false);
                $('#credit_hours').prop('required', false);
            }
        }

        $(document).on('click', '.create-lookup', function() {
            $('#exampleModalLabel').text($(this).attr('lookup-title'));
            $('.lookups-form').attr('select-input-id', $(this).attr('select-id'));
            let type = $(this).attr('lookup-type');

            let action = "{{ route('admin.lookups.store', 'type_slug:type_slug') }}";
            action = action.replace('type_slug:type_slug', type);
            $('.lookups-form').attr('action', action);
            $('.lookups-form').trigger("reset");
            if ($(this).attr('lookup-sub') && type == 'course_classifications') {
                $('.parent-input').attr('value', $('#course_classification_id').val());
            }


        });

        function storeLookup() {
            form = $('.lookups-form');

            if (form.parsley().isValid()) {

            } else {
                form.parsley().validate();
                return;
            }

            let selectInput = form.attr('select-input-id');
            let url = form.attr('action');
            let data = new FormData();
            let title_en = form.find('input[name="title_en"]').val();
            let title_ar = form.find('input[name="title_ar"]').val();
            let parent_id = form.find('input[name="parent_id"]').val();
            let image = form.find('input[name="image"]')[0];
            let token = form.find('input[name="_token"]').val();
            data.append('title_en', title_en);
            data.append('title_ar', title_ar);
            if (parent_id) {
                data.append('parent_id', parent_id ?? null);
            }

            if (image) {
                data.append('image', image ? image.files[0] : null);
            }

            console.log(data);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: data,
                enctype: 'multipart/form-data',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    $("#" + selectInput).append(
                        `<option value="${response.id}" selected>${response.title}</option>`);
                    $("#" + selectInput).select2('destroy');
                    $("#" + selectInput).select2();
                    $('#exampleModal').modal('toggle');
                }
            });

        }
    </script>
    <script>
        var marker;
        var map
        var geocoder
        var countries = @json($countries);
        var city_id = null;

        function initMap() {

            var myLatlng = new google.maps.LatLng(23.8859, 45.0792);
            var mapOptions = {
                zoom: 5,
                center: myLatlng
            }
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });

            function placeMarker(location) {
                if (marker && marker.setMap) {
                    marker.setMap(null);
                }
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });

                getAddress(location);


                $('#lat').val((typeof location.lat == 'number') ? location.lat : location.lat());
                $('#lng').val((typeof location.lng == 'number') ? location.lng : location.lng());
            }

            function getAddress(latLng) {
                geocoder.geocode({
                        'latLng': latLng
                    },
                    function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            console.log(results[0]);
                            if (results[0]) {
                                results[0].address_components.forEach(address => {
                                    address.types.forEach(type => {
                                        if (type == 'country') {
                                            var country = countries.filter(el => {
                                                return el.country_code == address.short_name;
                                            })[0];
                                            console.log(country);
                                            if (country) {
                                                $('#country_id').val(country.id).trigger('change');
                                            }
                                        }

                                    });
                                });
                                document.getElementById("address").value = results[0].formatted_address;
                            } else {
                                document.getElementById("address").value = "No results";
                            }
                        } else {
                            document.getElementById("address").value = status;
                        }

                    });


            }

            //Use Places Autocomplete
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
            autocomplete.addListener('place_changed', function() {
                // marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(10);
                }
                //Put markers on the place
                placeMarker(place.geometry.location);

            });


            @if ($course->lat && $course->lng)
                placeMarker({
                    lat: @json($course->lat),
                    lng: @json($course->lng)
                });
                map.setCenter({
                    lat: @json($course->lat),
                    lng: @json($course->lng)
                })
            @endif
        }

    </script>
    <script>

        function myPolicy() {
            // Get the checkbox
            var check = document.getElementById("has_special_policy");
            // Get the output text
            var texts = document.getElementById("mycheckboxdiv");

            // If the checkbox is checked, display the output text
            if (check.checked == true){
                texts.style.display = "flex";
            } else {
                texts.style.display = "none";
            }
        }
    </script>

    <script>
        function getCities(countryId, selected = city_id) {
            var targetCountry = null;
            if (countries.length) {
                targetCountry = countries.filter(country => {
                    return country.id == countryId;
                })[0];
            }

            if (targetCountry.cities) {
                if (targetCountry.cities.length) {
                    $('#city_id').empty();
                    $('#city_id').append(`<option value=""></option>`);
                    $.each(targetCountry.cities, function(key, city) {
                        $('#city_id').append(
                            `<option value="${city.id}" ${selected == city.id ? 'selected' : ''}>${city.title}</option>`
                        );
                        $('#city_id').select2('destroy');
                        $('#city_id').select2();
                    });
                }
            }
        }
    </script>

    <script>
        function filterInstructors(value) {
            console.log(value);
            var instructors = @json($instructors)

            var filtered = instructors.filter(function(instructor) {
                return instructor.name.includes(value);
            });

            if (filtered.length > 0) {
                $('.instructors').empty();
                $.each(filtered, function(key, instr) {
                    $('.instructors').append(`
                        <li>
                            <input type="checkbox" value="${instr.id}"  id="myCheckbox${instr.id}" name="instructor_id[]" required data-parsley-errors-container="#instructor_id_error" data-parsley-group="step-2"/>
                            <label class="label-input" for="myCheckbox${instr.id}"> <img src="${instr.image? instr.image.url : ''}">
                                ${instr.name}
                            </label>
                        </li>
                    `);
                });
            } else {
                $('.instructors').empty();
                $('.instructors').append(`
                    No Result found
                `);
            }
        }
    </script>
    <script>
        function storeInstructor() {
            var instructorForm = $('.instructor-create');
            $('.sv-inst').prop('disabled', true);
            console.log(instructorForm);
            if (instructorForm.parsley().isValid()) {

            } else {
                instructorForm.parsley().validate();
                $('.sv-inst').prop('disabled', false);
                return;
            }
            let url = instructorForm.attr('action');
            let name_en = instructorForm.find('input[name="name_en"]').val();
            let name_ar = instructorForm.find('input[name="name_ar"]').val();
            let mail = instructorForm.find('input[name="mail"]').val();
            let password = instructorForm.find('input[name="password"]').val();
            let mobile = instructorForm.find('input[name="mobile"]').val();
            let bio_en = instructorForm.find('textarea[name="bio_en"]').val();
            let bio_ar = instructorForm.find('textarea[name="bio_ar"]').val();
            let image = instructorForm.find('input[name="image"]')[0];
            console.log(image);
            let data = new FormData();
            data.append('name_ar', name_ar);
            data.append('name_en', name_en);
            data.append('mail', mail);
            data.append('password', password);
            data.append('mobile', mobile);
            data.append('bio_ar', bio_ar);
            data.append('bio_en', bio_en);
            data.append('image', image ? image.files[0] : null);

            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: data,
                enctype: 'multipart/form-data',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        $('.sv-inst').prop('disabled', false);
                        $('.instructors').append(`
                            <li>
                                <input type="checkbox" checked value="${response.id}"  id="myCheckbox${response.id}" name="instructor_id[]" required data-parsley-errors-container="#instructor_id_error" data-parsley-group="step-2"/>
                                <label class="label-input" for="myCheckbox${response.id}"> <img src="${response.image? response.image.url : ''}">
                                    ${response.name}
                                </label>
                            </li>
                        `);
                        $('#createInstructor').modal('toggle');
                        $(instructorForm).trigger("reset");
                    }
                },
                error:function(){
                    $('.sv-inst').prop('disabled', false);

                }
            });

        }
    </script>

    <script>
        function getAvailableEvaluation(value) {
            if (value == 'available') {
                $('.full-evaluation').show();

            } else {
                $('.full-evaluation').hide();
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            @if ($course->course_place_id)
                showPlaceSection("{{ $course->coursePlace->slug }}");
            @endif

            @if ($course->country_id)
                @if ($course->city_id)
                    city_id = "{{ $course->city_id }}"
                @endif
                getCities("{{ $course->country_id }}", "{{ $course->city_id }}")
            @endif

            @if ($course->course_classification_id)
                getSubClassifications("{{ $course->course_classification_id }}", @json($selected_course_sub_classifications))
            @endif

            @if ($course->course_availability_id)
                getTimeInputs("{{ $course->courseAvailability->slug }}")
            @endif
            @if ($course->course_accreditation_id)
                getAccrediteInputs("{{ $course->courseAccreditation->slug }}")
            @endif
            @if($course->evaluation)
            getAvailableEvaluation("{{ $course->evaluation }}")
        @endif

        });
    </script>
    <script>
        function get_sub_specialists(selected = null) {
            console.log(selected);
            var id = $('#target_group_id').val();
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{ app()->getLocale() }}/get_specialty/' + id,
                    success: function(data) {
                        $('#course_sub_specialty_id').empty();
                        $.each(data, function(key, sub_specialty) {
                            console.log(sub_specialty);
                            $('#course_sub_specialty_id');
                            $('#course_sub_specialty_id').append(
                                `<option value="${sub_specialty.id}" ${(selected && selected.includes(sub_specialty.id)) ? 'selected' : ''}>${sub_specialty.name}</option>`
                            );
                            $('#course_sub_specialty_id').select2('destroy');
                            $('#course_sub_specialty_id').select2();
                        });


                    }
                });
            }
        }
    </script>
    <script>
        @if ($course->image_en)
            $(document).ready(function() {
                $('#image_en').each(function() {
                    // Refs
                    var $file = $(this),
                        $label = $file.next('label'),
                        $labelText = $label.find('span'),
                        labelDefault = $labelText.text();

                    $label.addClass('file-ok').css('background-image',
                        "url({{ $course->image_en->getUrl('thumb') }} )");
                    $labelText.text('change image');
                });
            });
        @endif

        @if ($course->image_ar)
            $(document).ready(function() {
                $('#image_ar').each(function() {
                    // Refs
                    var $file = $(this),
                        $label = $file.next('label'),
                        $labelText = $label.find('span'),
                        labelDefault = $labelText.text();

                    $label.addClass('file-ok').css('background-image',
                        "url({{ $course->image_ar->getUrl('thumb') }} )");
                    $labelText.text('change image');
                });
            });
        @endif

        @if ($course->banner_en)
            $(document).ready(function() {
                $('#banner_en').each(function() {
                    // Refs
                    var $file = $(this),
                        $label = $file.next('label'),
                        $labelText = $label.find('span'),
                        labelDefault = $labelText.text();

                    $label.addClass('file-ok').css('background-image',
                        "url({{ $course->banner_en->getUrl('thumb') }} )");
                    $labelText.text('change image');
                });
            });
        @endif

        @if ($course->banner_ar)
            $(document).ready(function() {
                $('#banner_ar').each(function() {
                    // Refs
                    var $file = $(this),
                        $label = $file.next('label'),
                        $labelText = $label.find('span'),
                        labelDefault = $labelText.text();

                    $label.addClass('file-ok').css('background-image',
                        "url({{ $course->banner_ar->getUrl('thumb') }} )");
                    $labelText.text('change image');
                });
            });
        @endif

        @if ($course->video)
            $(document).ready(function() {
                $('#video').each(function() {
                    // Refs
                    var $file = $(this),
                        $label = $file.next('label'),
                        $labelText = $label.find('span'),
                        labelDefault = $labelText.text();

                    $label.addClass('file-ok').css('background-image',
                        "url({{ $course->video->getUrl('thumb') }} )");
                    $labelText.text('change video');
                });
            });
        @endif

        @if (count($course_sub_specialties))
            get_sub_specialists(@json($course_sub_specialties));
        @endif


    </script>

    <script>
        $("#has_general_price").change(function() {
            if ($(this).is(':checked')) {
                $(".price-field").show();
                $('#price').prop('required', true);
            } else {
                $(".price-field").hide();
                $('#price').prop('required', false);
            }
        });
    </script>

    <script>
        function setCityValue(value) {
            city_id = value;
        }
    </script>
