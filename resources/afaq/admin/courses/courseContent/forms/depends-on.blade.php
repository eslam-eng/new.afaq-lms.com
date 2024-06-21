<form action="" id="dependsOnForm" class="dependsOn-form" method="post" data-parsley-validate>
    @csrf
    <div class="row">
        <input type="hidden" name="id" value="{{ $lecture->id }}">
        <div class="form-group col-12">
            <label for="dependsOn">{{ __('lms.depends_on_lecture') }}</label>
            <select type="text" name="depends_on_id" id="dependsOn" class="form-control" required
                data-parsley-required-message="{{ trans('global.required') }}">
                <option value="" disabled selected>{{ __('lms.select') }}</option>
                @foreach ($section_lectures as $section_lecture)
                    <option value="{{ $section_lecture->id }}" {{ $lecture->depends_on_id == $section_lecture->id ? 'selected' : '' }}>{{ $section_lecture->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 form-group my-auto">
            <label for=""></label>
            <button type="button" class="btn btn-success dependsOn-submit" section-id="">
                {{ __('global.save') }}
            </button>
        </div>
    </div>
</form>
