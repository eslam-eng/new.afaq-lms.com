<style>
    .instructors {
        list-style-type: none;
    }

    .instructors li {
        display: inline-block;
    }

    .instructors input[type="checkbox"][id^="myCheckbox"] {
        display: none;
    }

    .label-input {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
        text-align: center;
    }

    .label-input:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    .label-input img {
        display: block;
        height: 75px;
        width: 75px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        border-radius: 50%;
    }

    :checked+.label-input {
        border-color: #ddd;
    }

    :checked+.label-input:before {
        content: "✓";
        background-color: grey;
        transform: scale(1);
    }

    :checked+.label-input img {
        transform: scale(0.9);
        /* box-shadow: 0 0 5px #333; */
        z-index: -1;
    }
</style>

<h6>{{ trans('global.step') }} 2</h6>
<fieldset>
    <div class="row form-group">
        <div class="col-3 mb-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createInstructor">
                + Add instructor
            </button>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" id="search-input" oninput="filterInstructors($(this).val())"
                placeholder="Search instructor">
        </div>
    </div>
    <ul class="instructors">
        @foreach ($instructors as $instructor)
            <li>
                <input type="checkbox" value="{{ $instructor->id }}" id="myCheckbox{{ $instructor->id }}"
                    name="instructor_id[]" required data-parsley-errors-container="#instructor_id_error"
                    data-parsley-group="step-2" data-parsley-required-message="{{ trans('global.required') }}" />
                <label class="label-input" for="myCheckbox{{ $instructor->id }}">{{ $instructor->image }}
                    {{ $instructor->name }}
                </label>
            </li>
        @endforeach

    </ul>
    <div id="instructor_id_error"></div>
</fieldset>
