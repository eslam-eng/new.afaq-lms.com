    <!-- Add Lecture  -->
    <div class="modal fade" id="normalLectureModal" tabindex="-1" role="dialog" aria-labelledby="normalLectureModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('lms.create_course_lecture') }}</h5>
                    <button type="button" onclick="$('.create-normal-form')[0].reset();$('#AddLectureLoading').text('');$('#AddLectureStatus').text('')" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="createSectionLecture" class="create-normal-form" method="post"
                        data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="type">{{ __('lms.type') }}</label>
                                <select type="text" name="lecture_type" id="type" class="form-control type-check" required
                                    data-parsley-required-message="{{ trans('global.required') }}">
                                    <option value="" disabled selected>{{ __('lms.select') }}</option>
                                    @foreach (['video', 'photo', 'file','attendance_design'] as $type)
                                        <option value="{{ $type }}">{{ __('lms.' . $type) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6" style="display: grid;">
                                <label class="required" for="accessing">{{ trans('lms.accessing') }}</label>
                                <select class="form-control select2 {{ $errors->has('accessing') ? 'is-invalid' : '' }}"
                                    name="accessing" id="accessing" required  data-parsley-required-message="{{ trans('global.required') }}">
                                    <option value="" disabled selected>{{ __('lms.select') }}</option>
                                    <option value="private">{{ __('lms.private') }}</option>
                                    <option value="public">{{ __('lms.public') }}</option>
                                </select>
                                @if ($errors->has('accessing'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('accessing') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.courseQuize.fields.exam_title_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label for="duration">{{ __('cruds.zoomMeeting.fields.duration') }}</label>
                                <input type="text" name="duration" id="duration" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                <input type="text" name="title_en" id="update_title_en" class="form-control" required
                                    data-parsley-required-message="{{ trans('global.required') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                <input type="text" name="title_ar" id="update_title_ar" class="form-control" required
                                    data-parsley-required-message="{{ trans('global.required') }}">
                            </div>
                            <div class="form-group col-12">
                                <label
                                    for="short_description_en">{{ __('cruds.course.fields.short_description_en') }}</label>
                                <textarea type="text" name="short_description_en" id="short_description_en" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-12">
                                <label
                                    for="short_description_ar">{{ __('cruds.course.fields.short_description_ar') }}</label>
                                <textarea type="text" name="short_description_ar" id="short_description_ar" class="form-control"></textarea>
                            </div>

                            <div class="form-group col-12">
                                <input type="file" name="file" id="add_lecture_attachment" onchange="uploadFile('add_lecture_attachment','{{ route('admin.courses.course-section-lectures.storeMedia') }}','file','AddLectureStatus','AddLectureLoading','AddLectureProgressBar','{{ csrf_token() }}',$('#type').val())"><br>
                                <input type="hidden" name="attachment" id="attachment-id">
                                <progress id="AddLectureProgressBar" value="0" max="100"
                                    style="width:100%;margin-top: 1rem;height: 20px;"></progress>
                                <h3 id="AddLectureStatus"></h3>
                                <p id="AddLectureLoading"></p>
                            </div>
                            <div class="col-12 form-group my-auto">
                                <label for=""></label>
                                <button type="button" class="btn btn-success normal-submit" disabled section-id="">
                                    {{ __('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('footer-scripts')
        <script>
            Dropzone.options.attachmentDropzone = {
                url: '{{ route('admin.courses.course-section-lectures.storeMedia') }}',
                maxFilesize: 10, // MB
                acceptedFiles: '.jpeg,.jpg,.png,.gif,.mp4,.mkv,.avi,.pdf,.doc,.docx,.xls,.xlsx,.csv',
                maxFiles: 1,
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                params: {
                    size: 2,
                    width: 4096,
                    height: 4096
                },
                success: function(file, response) {
                    $('form').find('input[name="attachment"]').remove()
                    $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    if (file.status !== 'error') {
                        $('form').find('input[name="attachment"]').remove()
                        this.options.maxFiles = this.options.maxFiles + 1
                    }
                },
                init: function() {
                    @if (isset($courseQuize) && $courseQuize->image)
                        var file = {!! json_encode($courseQuize->image) !!}
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
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
        <script>
            $(document).on('click', '.normal-button', function() {
                var section_id = $(this).attr('normal-section-id');
                var course_id = $(this).attr('normal-course-id');
                $('.normal-submit').attr('normal-section-id', section_id);
                $('.normal-submit').attr('normal-course-id', course_id);
            });
            $(document).on('click', '.normal-submit', function() {
                if (!$('.create-normal-form').parsley().isValid()) {
                    $('.create-normal-form').parsley().validate();
                    return;
                }

                var section_id = $(this).attr('normal-section-id');
                var course_id = $(this).attr('normal-course-id');

                console.log(section_id, course_id);
                var url = "{{ route('admin.courses.course-section-lectures.store') }}";
                url = url.replace('course_id', course_id);
                var form = $('.create-normal-form')[0];
                var formData = new FormData(form);
                formData.append('section_id', section_id);
                formData.append('course_id', course_id);

                $.ajax({
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    enctype: 'multipart/form-data',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $(`.section-card-${section_id}`).append(response);
                        $('#normalLectureModal').modal('toggle');
                        // $(`.card-opener-${section_id}`).click();
                        $('.create-normal-form').trigger("reset");
                        $('#AddLectureProgressBar').empty();
                        $('#AddLectureStatus').empty();
                        $('#AddLectureLoading').empty();
                    },
                    error: function() {

                    }
                });

            });
        </script>
    @endpush
