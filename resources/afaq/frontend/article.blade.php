@extends('layouts.front')
@section('content')
<script src="https://www.google.com/recaptcha/api.js?render=6Leib64iAAAAAGOCz3Ej5KDgAGrsysLUUEjynAae"></script>

<section class="idu-programss">
    <div class="container">

        <div class="row background-row row background-row space-row" style="    border-radius: 21px;
        ">

            <div class="tabcontent">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
                @endif
                <!-- <div class="blog-size d-flex col-md-12">
                        <h3>{{ $blog->title }}</h3>

                        @if($blog->featured_image)
                            <div class="col-lg-12">
                                <img src="{{ $blog->featured_image->getUrl() }}">
                            </div>
                            <div class="col-lg-12 blogText">
                                <p>{!! $blog->page_text   !!} </p>
                            </div>
                       @else
                        <div class="col-lg-12 blogText">
                            <p>{!! $blog->page_text   !!}</p>
                        </div>
                        @endif
                </div>  -->
                <div class="one-course-page w-100">
                    <!-- <div class="entry-header clearfix">
                        <div class="container">
                            <div class="entry-title-left">
                                <div class="entry-title">
                                    <h2 class="h1">Blog</h2>
                                </div>
                            </div>
                            <div class="entry-title-right">
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                        <div class="blog-page" style="padding-top:200px; ">
                            <div class="blog-title" style="text-align: center">

                                <h2>{{app()->getLocale()=='en' ? $blog->title ?? '' : $blog->title_ar ?? ''}}</h2>
                                <div class="stm_post_details blog-page">
                                    {{-- <ul class="clearfix post_meta">
                                        @if($blog->created_at)
                                        <li class="post_date h6"><i class="far fa-clock"></i><span>{{date('M d, Y' , strtotime($blog->created_at))}}</span></li>
                                        @endif

                                        @if($blog->editor)
                                        <li class="post_by h6"><i class="fa fa-user"></i>{{__('frontend.posted_by')}}:- <span>{{$blog->editor->name}}</span></li>
                                        @endif
                                        @if($blog->categories)
                                            <li class="post_cat h6">
                                                <i class="fa fa-flag"></i> {{__('global.category')}}:-
                                                @foreach($blog->categories as $cat)
                                                    <span>
                                                        {{app()->getLocale()=='en' ? $cat->name ?? '' : $cat->name ?? ''}},
                                                    </span>
                                                @endforeach
                                            </li>
                                        @else
                                            <li class="post_cat h6"><i class="fa fa-flag"></i> Category: <a href="#"><span>Uncategorized</span></a>
                                            </li>
                                        @endif
                                    </ul> --}}
                                    {{-- <div class="comments_num">
                                        <a href="#" class="post_comments h6"><i class="far fa-comments"></i> {{count($approved_comments) > 0 ? count($approved_comments) : __('frontend.no_comment')}}</a>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="blog-thumbnail">
                                <div class="post_thumbnail">
                                    <img src="{{isset($blog->featured_image->url) ? asset($blog->featured_image->url) : asset('afaq\logo.png')}}" class="img-responsive wp-post-image" alt="Online CME hours for SCFHS" >
                                </div>
                            </div>
                            <div class="text_block clearfix w-100">
                                {!! app()->getLocale()=='en' ? $blog->excerpt ?? '' : $blog->excerpt_ar ?? '' !!}

                                {!! app()->getLocale()=='en' ? $blog->page_text ?? '' : $blog->page_text_ar ?? '' !!}
                            </div>
                            {{-- <div class="share-blog-page share-items">
                                <button class="btn-share fac-share">
                                    <i class="fab fa-facebook"></i>
                                    <span>facebook</span>
                                </button>
                                <button class="btn-share twitter-share">
                                    <i class="fab fa-twitter"></i>
                                    <span>twitter</span>
                                </button>
                                <button class="btn-share pinterist-share">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>whatsapp</span>
                                </button>
                                <button class="btn-share linked-share">
                                    <i class="fab fa-linkedin-in"></i>
                                    <span>linkedin-in</span>
                                </button>
                                <button class="btn-share digg-share">
                                    <i class="fab fa-google"></i>
                                    <span>google</span>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

{{--
            <div class="tabcontent ">
                <div class="section-comments container">
                    <div class="section-header">
                        <h3 class="section-title">  {{__('lms.Comments')}} ({{count($approved_comments)}})</h3>
                        <img src="{{ asset('frontend/img/wave.svg') }}" class="wave" alt="wave">
                    </div>
                    @if(!empty($approved_comments))
                    <div class="comments bordered padding-30 rounded">

                        <ul class="comments">
                            @foreach($approved_comments as $c_comment)
                            <!-- comment item -->
                            <li class="comment rounded">
                                <div class="thumb">
                                    <img src="{{ asset('frontend/img/default_user.png') }}" class="default_user" alt="John Doe">
                                </div>
                                <div class="details">
                                    <h4 class="name"><a href="javascript:;">{{$c_comment['name']}}</a></h4>
                                    <span class="date"> {{date("M d, Y H:i:m",strtotime($c_comment['created_at']))}}</span>
                                    <p>{{$c_comment['comment']}}</p>
                                    <!-- <a href="#" class="btn btn-default btn-sm">Reply</a> -->
                                </div>
                            </li>
                            <!-- comment item -->
                            @endforeach
                            <!-- <li class="comment child rounded">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/img/default_user.png') }}" class="default_user" alt="John Doe">
                                    </div>
                                    <div class="details">
                                        <h4 class="name"><a href="#">Helen Doe</a></h4>
                                        <span class="date">Jan 08, 2021 14:41 pm</span>
                                        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                                        <a href="#" class="btn btn-default btn-sm">Reply</a>
                                    </div>
                                </li> -->

                        </ul>
                    </div>
                    @endif
                </div>
                <div class="section-leave-comments section-comments container">
                    <div class="section-header">
                        <h3 class="section-title">  {{__('lms.Leave_Comment')}}</h3>
                        <img src="{{ asset('frontend/img/wave.svg') }}" class="wave" alt="wave">
                    </div>
                    <div class="comment-form rounded padding-30">

                        <form id="comment-form" class="comment-form" action="{{ route('comment_create') }}" method="post">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <div class="messages"></div>

                            <div class="row">

                                <div class="column col-md-12">
                                    <!-- Comment textarea -->
                                    <div class="form-group">
                                        <textarea name="comment" id="InputComment"
                                                  class="form-control" rows="4"
                                                  placeholder="{{__('lms.your_Comment')}}"
                                                  required="required"></textarea>
                                    </div>
                                </div>

                                <div class="column col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="InputName"
                                               name="name" placeholder="{{__('lms.your_name')}}" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="InputEmail"
                                               name="email"
                                               placeholder="{{__('lms.Email_address')}}" required="required">
                                    </div>
                                </div>
                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="phone" class="form-control" id="InputPhone"
                                               name="phone" placeholder="{{__('lms.Phone')}}" required="required">
                                    </div>
                                </div>

                                <input type="hidden" name="g-recaptcha-response" id='g-recaptcha-response'>

                            </div>

                            <button type="submit" name="submit" id="submit" value="{{__('lms.Submit')}}Submit" class="btn btn-default">Submit</button>
                            <!-- Submit Button -->

                        </form>
                    </div>
                </div>
            </div> --}}





        </div>

    </div>
</section>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Leib64iAAAAAGOCz3Ej5KDgAGrsysLUUEjynAae', {
            action: 'submit'
        }).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>

@endsection
