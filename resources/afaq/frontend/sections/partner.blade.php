@if (count($partners))
    <div class="out-partner container">
        <h3>{{ __('frontend.partner') }}</h3>

        <div class="partner-items  onweb-view">
            @foreach ($partners as $k1 => $v1)
                @if ($loop->index < 5)
                    <div class=" partner-items-img">
                        <img src="{{ asset($v1->image->url ?? '') }}" alt="">
                    </div>
                @else
                @break
            @endif
        @endforeach

    </div>

    <div class="partner-items  onmobile-view">
        <div class="owl-carousel latestcourse-card-viewcard owl-theme">

            @foreach ($partners as $k1 => $v1)
                @if ($loop->index < 5)
                    <div class=" partner-items-img">
                        <img src="{{ asset($v1->image->url ?? '') }}" alt="">
                    </div>
                @else
                 @break
                @endif
        @endforeach

    </div>
</div>
</div>
@endif
