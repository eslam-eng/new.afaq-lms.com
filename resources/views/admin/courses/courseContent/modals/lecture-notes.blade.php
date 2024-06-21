    <!-- Add Lecture  -->
    <div class="modal fade" id="lectureNotes" tabindex="-1" role="dialog" aria-labelledby="lectureNotesTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('lms.lecutre_notes') }}</h5>
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
    <script src="{{ asset('app-assets/js/scripts/repeater.js') }}"></script>
    <script>
        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
    </script>
        <script>
            $(document).on('click', '.open-notes-modal', function() {
                var id = $(this).data('id');
                var section_id = $(this).data('section-id');
                var url = "{{ route('admin.courses.course-section-lectures.notes') }}";
                url = url + '?lecture_id=' + id + '&section_id=' + section_id;
                $.get(url).done(function(res) {

                    $('#lectureNotes .modal-body').html(res);

                    $('#lectureNotes').modal('toggle');
                });
            });
        </script>
        <script>
            $(document).on('click', '.notes-submit', function() {
                if (!$('.notes-form').parsley().isValid()) {
                    $('.notes-form').parsley().validate();
                    return;
                }

                var lecture_id = $(this).attr('lecture-id');
                var url = "{{ route('admin.courses.course-section-lectures.notes.store') }}";
                var form = $('.notes-form')[0];
                var formData = new FormData(form);
                    formData.append('lecture_id',lecture_id);

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
                        $('#lectureNotes').modal('toggle');
                        $('.notes-form').trigger("reset");
                    },
                    error: function() {

                    }
                });

            });
        </script>

    @endpush
