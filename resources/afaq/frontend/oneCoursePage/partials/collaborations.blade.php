
@if (count($oneCourse->collaborations))
    <div class="collaboration-imgs">
        <h4>
            {{ __('global.scientific_association_partners') }}
        </h4>
        <div class="the-logo-nd">

            <div class="partner_logo d-flex flex-wrap w-100">
                    @foreach ($oneCourse->collaborations as $collaboration)
                    @if ($collaboration->image_url)
                        <img src="{{ $collaboration->image_url ?? '' }}" alt="{{ $collaboration->title }}">
                    @else
                        <p>{{ $collaboration->title }}</p>
                    @endif
                    @endforeach
                </div>
        </div>
    </div>
@endif
