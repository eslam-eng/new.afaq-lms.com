@if (count($oneCourse->collaborations))
    <div class="association_partners">
        <h4>
            {{ __('global.scientific_association_partners') }}
        </h4>
        <div class="partner_logos_area owl-carousel owl-drag d-flex flex-row">
            @foreach ($oneCourse->collaborations as $collaboration)
                <div class="partner_logo d-flex">
                    @if ($collaboration->image_url)
                        <img src="{{ $collaboration->image_url ?? '' }}" alt="{{ $collaboration->title }}">
                    @else
                        <p>{{ $collaboration->title }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
