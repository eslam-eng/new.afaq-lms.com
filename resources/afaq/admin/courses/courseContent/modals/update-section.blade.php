    <!-- Update Sections -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('lms.update_course_section') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="updateSectionForm" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="section_id" id="updateSectionId">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                                <input type="text" name="title_en" id="update_title_en" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-6">
                                <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                                <input type="text" name="title_ar" id="update_title_ar" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 form-group my-auto">
                                <label for=""></label>
                                <button type="button" class="btn btn-success update-content" section-id="">
                                    {{ __('global.update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
