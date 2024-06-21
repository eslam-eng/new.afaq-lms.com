@extends('layouts.front')
@section('title')
    <title>{{ __('frontend.blogpage') }}</title>
@endsection
@section('content')
<style>
    .innerheader-nd {
        height: 50vh !important;
    }
    section.idu-programss.blog-page-nd {
    padding-top: 100px;
}
    .tabcontent {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    justify-content: start;
    align-items: center;
    margin-bottom: 50px
}

.blog-size {
    width: 30%;
    /* height: 350px; */
    margin: 10px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 8px 16px #a5a5a5;
    padding: 10px;
}

.blog-writer-img {
    height: 250px;
}

.blog-writer-img img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
.blog-card-nd {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    box-shadow: 0px 2px 5px #656565bf;
}

.blog-date-description-nd {
    width: 100%;
    /* height: 250px; */
}
.blog-date-description-nd h3 {
    height: 30px;
    overflow: hidden;
}
.blog-card-nd img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}
    /* .precemp{
      bottom: 150px;
    } */
    @media screen and (max-width: 1200px) {
        .innerheader-nd {
            height: 65vh !important;
        }

        .home-page-nd.onregister-page {
            z-index: 1;
            position: relative;
        }
        .blog-size{
            width: 48%;
        }
    }

    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
        .blog-size{
            width: 100%;
        }
    }
</style>
<div class="br-div px-5">
    <ul class="br-ul">
        <li><a href="{{ route('site-home',['locale'=>app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
        <li><a href="{{ route('all-courses',['locale'=>app()->getLocale()]) }}">{{ __('frontend.blogpage') }}</a> </li>
    </ul>
</div>
<section class="idu-programss blog-page-nd">
    <div class="container sit-container the-newblogpage-nd">
        <div class="row ">
            <div class="tabcontent  mt-5">
                @foreach ($blogs as $blog)
                <div class="blog-size ">
                    <a href='{{url(app()->getLocale()."/blogs/view/".$blog->id)}}'>
                    <!-- <i class="far fa-newspaper"></i> -->

                    <div class="blog-card-nd">
                        @if($blog->featured_image)
                        <div class="data-img-nd">

                                <img src=" {{$blog->editor->image ? ($blog->editor->image->url ?? asset('frontend/img/avatar.jpg'))  : asset('frontend/img/avatar.jpg')}}">

                        </div>
                        <!-- <div class="data-blogcard-nd">
                            <p>{!! app()->getLocale()=='en' ? $blog->excerpt ?? '' : $blog->excerpt_ar ?? '' !!}</p>
                            <p>{!! \Illuminate\Support\Str::limit(app()->getLocale()=='en' ? $blog->page_text ?? '' : $blog->page_text_ar ?? '', 500) !!}</p>
                            <a href='{{url(app()->getLocale()."/blogs/view/".$blog->id)}}'>{{__('lms.readMore')}}</a>
                        </div> -->

                        @else
{{--                        <div class="row">--}}
{{--                            <p>{!! app()->getLocale()==' en' ? $blog->page_text ?? '' : $blog->page_text_ar ?? '' !!}</p>--}}
{{--                        </div>--}}

                        @endif
                    </div>
                    <div class="blog-date-description-nd">
                        <h3>{{ app()->getLocale()=='en' ? $blog->title ?? '' : $blog->title_ar ?? '' }}</h3>
                        <div class="blog-date-nd">
                            <span>{{ date('Y-m-d',strtotime($blog->created_at)) }}</span>
                            <em><i class="fas fa-calendar-week"></i></em>
                        </div>
                        <div class="blog-writer-name">
                            @if($blog->featured_image)
                                <div class="blog-writer-img">
                                    <img class="w-100" src="{{ $blog->featured_image->getUrl() }}" alt="">
                                </div>
                            @endif
                            <span>{{ $blog->editor->name ?? '' }}</span>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection
