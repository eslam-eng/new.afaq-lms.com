@extends('layouts.admin')
@section('styles')
    <style>
        .sections #accordion .card .card-header {
            width: 100% !important;
            background-color: #e9e9e9 !important;
            padding: 0 !important;
        }

        .align-start {
            text-align: start;
        }

        .card-body {
            background-color: #fbfafa;
        }

        .dropdown-menu {
            min-width: 100px !important;
        }

        .parsley-errors-list {
            list-style: none;
            padding: 0;
            color: red;
        }

        .col-sm-4,
        .col-md-6,
        .col-md-10 {
            width: auto !important;
        }

        .lecture-div {
            width: 100%;
            background-color: #f0f0f0;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 1px 1px 1px 1px grey;
            margin-bottom: 1rem;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="pr-2 pl-2 pt-2">
            <h3>{{ __('lms.add_course_section') }}</h3>
            <form action="" id="addSectionForm" method="post" data-parsley-validate>
                @csrf
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                <div class="row flex-wrap">
                    <div class="form-group col-md-5 col-sm-12">
                        <label for="title_en">{{ __('cruds.exam.fields.title_en') }}</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" required
                            data-parsley-required-message="{{ trans('global.required') }}">
                    </div>
                    <div class="form-group col-md-5 col-sm-12">
                        <label for="title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control" required
                            data-parsley-required-message="{{ trans('global.required') }}">
                    </div>
                    <div class="col-md-2 col-sm-12 form-group my-auto">
                        <button type="button" class="btn btn-success add-content w-100">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="pr-2 pl-2 pt-2">
            <div class="sections">
                @include('admin.courses.courseContent.course-section-accordion', ['sections' => $sections])
            </div>
        </div>
    </div>
    @include('admin.courses.courseContent.modals.update-section')
    @include('admin.courses.courseContent.modals.add-lecture')
    @include('admin.courses.courseContent.modals.add-zoom')
    @include('admin.courses.courseContent.modals.add-quize')
    @include('admin.courses.courseContent.modals.update-lecture')
    @include('admin.courses.courseContent.modals.update-zoom')
    @include('admin.courses.courseContent.modals.update-quize')
    @include('admin.courses.courseContent.modals.depends-on')
    @include('admin.courses.courseContent.modals.lecture-notes')
@endsection
@push('footer-scripts')
    @include('admin.courses.courseContent.loader')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('.add-content').on('click', function() {
            if (!$('#addSectionForm').parsley().isValid()) {
                $('#addSectionForm').parsley().validate();
            }

            var data = $('#addSectionForm').serialize();
            var url = "{{ route('admin.courses.course-sections.store') }}";
            $.post(url, data).done(function(response) {
                $('.sections #accordion').append(response);
                $('#addSectionForm').trigger('reset')
            });
        });

        $('.update-content').on('click', function() {
            var data = $('#updateSectionForm').serialize();
            var url = "{{ route('admin.courses.course-sections.update', 'id') }}";
            url = url.replace('id', $(this).attr('section-id'));

            var id = $(this).attr('section-id');
            $.post(url, data).done(function(response) {
                $(`#card-${id}`).empty().html(response);
                $('#exampleModalCenter').modal('toggle');
            });
        });
        $(document).on('click', '.delete-section', function() {
            var id = $(this).attr('delete-section-id');
            var url = "{{ route('admin.courses.course-sections.destroy', 'id') }}";
            url = url.replace('id', id);

            $.post(url, {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',
                'id': id
            }).done(function(response) {
                $(`#card-${id}`).remove();
            });
        });

        $(document).on('click', '.delete-lecture', function() {
            var id = $(this).attr('delete-lecture-id');
            var url = "{{ route('admin.courses.course-section-lectures.destroy', 'id') }}";
            url = url.replace('id', id);

            $.post(url, {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',
                'id': id
            }).done(function(response) {
                $(`#lecture-${id}`).remove();
            });
        });
    </script>
    <script>
        $(document).on('click', '.updateSectionButton', function() {
            $('#updateSectionForm').find('input[name="section_id"]').val($(this).attr('course-section-id'));
            $('#updateSectionForm').find('input[name="title_en"]').val($(this).attr('course-section-title-en'));
            $('#updateSectionForm').find('input[name="title_ar"]').val($(this).attr('course-section-title-ar'));
            $('#updateSectionForm').find('.update-content').attr('section-id', $(this).attr('course-section-id'));
        });
    </script>
    <script>
        @foreach ($sections as $sec)
            $(function() {
                $("#section-card-{{ $sec->id }}").sortable({
                    connectWith: ".connectedSortable-{{ $sec->id }}",
                    opacity: 0.5,
                    dropOnEmpty: true,
                    dropOnEmpty: true,
                    // connectWith: '.sortable',
                    tolerance: "pointer",
                    revert: true,
                    cursor: "move",
                });

                $(".connectedSortable-{{ $sec->id }}").on("sortupdate", function(event, ui) {
                    var lecture_array = [];
                    $("#section-card-{{ $sec->id }} .lecture-div").each(function(index) {
                        if ($(this).attr('lecture-id')) {
                            lecture_array[index] = $(this).attr('lecture-id');
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.courses.course-section-lectures.sorting') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            lectures: lecture_array,
                            section_id: "{{ $sec->id }}"
                        },
                        success: function(data) {
                            console.log('success');
                        }
                    });

                });
            });
        @endforeach
    </script>
@endpush
