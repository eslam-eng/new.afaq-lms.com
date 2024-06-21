    <!-- Add Lecture  -->
    <div class="modal fade" id="dependOnModal" tabindex="-1" role="dialog" aria-labelledby="dependOnModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('lms.depends_on_lecture') }}</h5>
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
            $(document).on('click','.open-dependon-modal',function(){
                var id = $(this).data('id');
                var section_id = $(this).data('section-id');
                var url = "{{ route('admin.courses.course-section-lectures.dependsOn') }}";
                url = url+'?lecture_id='+id+'&section_id='+section_id;
                $.get(url).done(function(res){

                    $('#dependOnModal .modal-body').html(res);

                    $('#dependOnModal').modal('toggle');
                });
            });
        </script>
        <script>

            $(document).on('click', '.dependsOn-submit', function() {
                if (!$('.dependsOn-form').parsley().isValid()) {
                    $('.dependsOn-form').parsley().validate();
                    return;
                }

                var url = "{{ route('admin.courses.course-section-lectures.dependsOn') }}";
                var form = $('.dependsOn-form')[0];
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
                        $('#dependOnModal').modal('toggle');
                        // $(`.card-opener-${section_id}`).click();
                        $('.dependsOn-form').trigger("reset");
                    },
                    error: function() {

                    }
                });

            });
        </script>
    @endpush
