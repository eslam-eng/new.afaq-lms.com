@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 50vh !important;
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
    }

    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
    }
</style>
<section class="idu-programss blog-page-nd">
    <div class="container sit-container the-newblogpage-nd">
        <div class="row ">
            <div class="tabcontent ">
                @foreach ($blogs as $blog)
                <div class="blog-size ">
                    <!-- <i class="far fa-newspaper"></i> -->

                    <div class="blog-card-nd">
                        @if($blog->featured_image)
                        <div class="data-img-nd">
                            <a href='{{url(app()->getLocale()."/blogs/view/".$blog->id)}}'>
                                <img src="{{ $blog->featured_image->getUrl() }}">
                            </a>
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
                            <div class="blog-writer-img">
                                <img class="w-100" src="{{$blog->editor->image ? ($blog->editor->image->url ?? asset('frontend/img/avatar.jpg'))  : asset('frontend/img/avatar.jpg')}}" alt="">
                            </div>
                            <span>{{ $blog->editor->name ?? '' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection
