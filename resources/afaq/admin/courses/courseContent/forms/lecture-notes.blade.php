<form action="" id="notesForm" class="notes-form" method="post" data-parsley-validate>
    @csrf
    <input type="hidden" name="course_section_lecture_id" value="{{ $lecture->id }}">
    <input type="hidden" name="course_id" value="{{ $lecture->course_id }}">
    <input type="hidden" name="course_section_id" value="{{ $lecture->course_section_id }}">

    <div class="repeater">
        <div data-repeater-list="notes">
            @forelse ($notes as $note)
                <div data-repeater-item class="row">
                    <div class="form-group col-12">
                        <label for="">{{ __('lms.in_time') }}</label>
                        <input type="number" min="0" class="form-control" name="in_time" value="{{ $note->in_time }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('lms.note_en') }}</label>
                        <textarea class="form-control" name="note_en" id="" cols="10" rows="5" required>{{ $note->note_en }}</textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('lms.note_ar') }}</label>
                        <textarea class="form-control" name="note_ar" id="" cols="10" rows="5" required>{{ $note->note_ar }}</textarea>
                    </div>
                    <div class="col-12 row justify-content-end">
                        <div class="form-group">
                            <label for="repeater-delete"></label>
                            <button id="repeater-delete" class="btn btn-danger form-control" data-repeater-delete
                                type="button">{{ trans('global.delete') }} </button>
                        </div>
                    </div>
                </div>
            @empty
                <div data-repeater-item class="row">
                    <div class="form-group col-12">
                        <label for="">{{ __('lms.in_time') }}</label>
                        <input type="number" min="0" class="form-control" name="in_time" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('lms.note_en') }}</label>
                        <textarea class="form-control" name="note_en" id="" cols="10" rows="5" required></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="">{{ __('lms.note_ar') }}</label>
                        <textarea class="form-control" name="note_ar" id="" cols="10" rows="5" required></textarea>
                    </div>
                    <div class="col-12 row justify-content-end">
                        <div class="form-group">
                            <label for="repeater-delete"></label>
                            <button id="repeater-delete" class="btn btn-danger form-control" data-repeater-delete
                                type="button">{{ trans('global.delete') }} </button>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>

        <button id="repeater-add" data-repeater-create class="btn btn-primary form-control col-2 my-2" type="button">
            {{ trans('global.add') }} </button>
    </div>
    <div class="row">


        <div class="col-12 form-group my-auto">
            <label for=""></label>
            <button type="button" class="btn btn-success notes-submit" lecture-id="{{ $lecture->id }}">
                {{ __('global.save') }}
            </button>
        </div>
    </div>
</form>
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
