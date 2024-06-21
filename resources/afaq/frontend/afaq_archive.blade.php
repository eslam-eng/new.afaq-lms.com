@extends('layouts.front')
@section('content')

<style>
    .card-result {
        margin-top: 150px;
    }

    .card-details.sm-card-list .shared-card.card-activities {
        margin-bottom: 0 !important;
    }

    .card-result.d-flex.flex-wrap .card-details.sm-card-list {
        width: 20vw !important;
        position: relative;
    }

    .case-course {
        display: flex;
        align-items: center;
        width: 90%;
        background: #8D8D8D;
        padding: 5px;
        justify-content: center;
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
        margin: 0 auto;
        position: absolute;
        bottom: 40px;
        left: calc(50% - 45%);
    }

    .case-course.remove-reminder {
        background: #F44336;
    }

    .case-course.remid-me {
        background: #1279CB;
    }
</style>

<div class="container">
    <div class="card-result d-flex flex-wrap justify-content-between">
        @foreach ($wishlist as $list)

        <div class="card-details sm-card-list">
            @include('frontend.partials.topactivity-course-card', [
            'course' => $list->course,
            ])
            <div class="case-course remove-reminder">
                <a href="">
                    <span><i class="fa-solid fa-bell-slash"></i> <em>REMOVE REMINDER</em></span>
                </a>
            </div>
        </div>

        @endforeach
    </div>
</div>



@endsection
