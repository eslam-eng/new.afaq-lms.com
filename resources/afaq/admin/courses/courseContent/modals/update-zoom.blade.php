    <!-- Add Lecture  -->
    <div class="modal fade" id="updateZoomLectureModal" tabindex="-1" role="dialog" aria-labelledby="updateZoomLectureModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('cruds.zoomMeeting.title_singular') }}</h5>
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
            $(document).on('click','.update-zoom-button', function() {
                var lecture_id = $(this).attr('lecture-id');
                var lec_url = "{{ route('admin.courses.course-section-lectures.show', 'id') }}";
                lec_url = lec_url.replace('id', lecture_id);
                $('.zoom-update').attr('lecture-id',lecture_id);
                $.get(lec_url).done(function(response) {
                    $('#updateZoomLectureModal .modal-body').empty().html(response)
                });

                $('#updateZoomLectureModal').modal('toggle');
            });

            $(document).on('click','.zoom-update', function() {
                if (!$('.update-zoom-form').parsley().isValid()) {
                    $('.update-zoom-form').parsley().validate();
                    return;
                }

                var lecture_id = $(this).attr('lecture-id');

                var url = "{{ route('admin.courses.course-section-lectures.update','id') }}";
                url = url.replace('id', lecture_id);
                var form = $('.update-zoom-form')[0];
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
                        $('#updateZoomLectureModal').modal('toggle');

                    },
                    error: function() {

                    }
                });

            });
        </script>
    @endpush
