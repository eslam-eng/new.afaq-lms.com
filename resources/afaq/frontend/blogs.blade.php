@extends('layouts.front')
@section('content')

<style>
    .innerheader-nd {
        height: 50vh !important;
    }
    /* .precemp{
      bottom: 150px;
    } */
</style>

<section class="idu-programss">
    <div class="container sit-container">
        <!-- <div class="row">
            <div class="title-dyn">
                <h3 class="page-title">IDU Blogs </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>

                    <li class="breadcrumb-item">Blogs</li>
                </ol>
            </div>
        </div> -->

        <div class="row background-row row background-row space-row">

            <div class="tabcontent">
                <div class="blog-size d-flex row p-4">
                    @foreach ($blogs as $blog)

                        <h3>{{ $blog->title }}</h3>

                        @if($blog->featured_image)
                            <div class="col-lg-8">
                                <p>{!! $blog->page_text   !!}</p>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ $blog->featured_image->getUrl() }}">
                            </div>
                       @else
                        <div class="col-lg-12">
                            <p>{!! $blog->page_text   !!}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mf-paginator">
                {{ $blogs->links() }}
            </div>

        </div>

    </div>
</section>

@endsection
