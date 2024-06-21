<div class="course_reviews">
    <h4> {{ __('global.reviews') }} </h4>
    @foreach ($oneCourse->reviews->where('status', 1) as $k => $v)
        <div class="d-flex flex-row pt-3">
            <img src="{{ asset(isset($v->user->personal_photo->url) ? $v->user->personal_photo->url : '/nazil/imgs/manager-1.jpeg') }}" alt="instructor image">
            <div class="reviewer_info d-flex flex-column">
                <p>
                    {{ $v->created_at ? $v->created_at->diffForHumans() : '' }}
                </p>
                <div class="d-flex flex-row">
                    <span class="reviewer_name">
                        {{ $v->user->name ?? '' }}
                    </span>

                </div>
                <div class="review_starts">
                    @for ($i = 0; $i < 5 - $v->rate; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < $v->rate; $i++)
                        <i style="color: #ffd43b" class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p>
                    {{ $v->review ?? '' }}
                </p>
            </div>
        </div>
    @endforeach
</div>
