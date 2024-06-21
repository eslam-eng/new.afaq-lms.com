    <!-- Add Lecture  -->
    <div class="modal fade" id="updateNormalLectureModal" tabindex="-1" role="dialog"
        aria-labelledby="updateNormalLectureModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('global.update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

    @push('footer-scripts')
        <script>

            Dropzone.options.updateDropzone = {
                url: '{{ route('admin.courses.course-section-lectures.storeMedia') }}',
                maxFilesize: 1, // MB
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
                    $('form').append('<input type="hidden" name="attachment" value="' + response
                        .name + '">');
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    if (file.status !== 'error') {
                        $('form').find('input[name="attachment"]').remove()
                        this.options.maxFiles = this.options.maxFiles + 1
                    }
                },
                init: function() {
                    @if (isset($lecture) && $lecture->attachment)
                        var file = {!! json_encode($lecture->attachment) !!}
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file
                            .preview_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="attachment" value="' + file
                            .file_name + '">')
                        this.options.maxFiles = this.options.maxFiles - 1
                    @endif
                },
                error: function(file, response) {
                    if ($.type(response) === 'string') {
                        var message =
                            response //dropzone sends it's own error messages in string
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
            $(document).on('click', '.update-file-button', function() {
                var lecture_id = $(this).attr('lecture-id');
                var lec_url = "{{ route('admin.courses.course-section-lectures.show', 'id') }}";
                lec_url = lec_url.replace('id', lecture_id);
                $('.normal-update').attr('lecture-id', lecture_id);
                $.get(lec_url).done(function(response) {
                    $('#updateNormalLectureModal .modal-body').empty().html(response);

                });

                $('#updateNormalLectureModal').modal('toggle');

            });
            $(document).on('click', '.normal-update', function() {
                if (!$('.update-normal-form').parsley().isValid()) {
                    $('.update-normal-form').parsley().validate();
                    return;
                }
                var lecture_id = $(this).attr('lecture-id');

                var url = "{{ route('admin.courses.course-section-lectures.update', 'id') }}";
                url = url.replace('id', lecture_id);
                var form = $('.update-normal-form')[0];
                var formData = new FormData(form);

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
                        $(`#lecture-${lecture_id}`).empty().html(response);
                        $('#updateNormalLectureModal').modal('toggle');
                    },
                    error: function() {

                    }
                });

            });
        </script>
    @endpush
