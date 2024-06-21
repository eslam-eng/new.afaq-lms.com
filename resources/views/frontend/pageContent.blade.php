@extends('layouts.front')
@section('content')
    <style>
         @media screen and (max-width: 830px) {
            .precemp {
                bottom: 30px;
            }

        }
        .innerheader-nd.d-flex.justify-content-between {
            height: 42vh;
        }
        .precemp {
            bottom: 150px;
        }
    </style>
    <div class="container" style="padding: 30px 0px 167px 0px;background-color: #e1e5e7;">
        <div style="margin: 20px;">
            {!! app()->getLocale() == 'en' ? $page_content->page_text : $page_content->page_text_ar !!}
        </div>

    </div>
@endsection
