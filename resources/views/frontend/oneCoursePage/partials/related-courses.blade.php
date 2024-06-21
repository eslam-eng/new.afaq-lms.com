@if (count($related_courses))
    <div class="related_courses">
        <h4>
            {{ __('global.related_courses') }}
        </h4>
        <div class="related d-flex flex-wrap px-0">
            @foreach ($related_courses as $v1)
                <div class="col-md-6 col-lg-4 col-sm-12 related-item">
                    @include('frontend.partials.course-card', [
                        'course' => $v1,
                    ])
                </div>
            @endforeach
        </div>
    </div>
@endif
