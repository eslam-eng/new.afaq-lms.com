@extends('layouts.static')
@section('content')

@include('frontend.sections.slider' , ['sliders' => $sliders])
<!-- *********** end-slider ******************** -->

@include('frontend.sections.icontext',['iconTexts' => $iconTexts])

<!-- *********** end-our-IconText ******************** -->
@include('frontend.sections.course_card', ['courses' => $courses,'courseCategories'=>$courseCategories])

<!-- *********** end-all-category ******************** -->

@include('frontend.sections.slidercard', ['sliderCards' => $sliderCards])
<!-- *********** end-slidercard ******************** -->

<!-- *********** end-Our Blog ******************** -->
@include('frontend.sections.partner',['partners'=>$partners])


<!-- *********** end-our-IconTextDescription ******************** -->
@include('frontend.sections.blog',['blogs'=>$blogs])

@endsection

@section('scripts')
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
    $(document).ready(function() {

        $('.blogslider').slick({
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3,
            infinite: true,
            initialSlide: 2,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 831,
                    settings: {
                        arrows: false,
                        centerMode: true,

                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });

    });
</script>
<script>
    var next_src = $('.carousel-inner.kenburn-slider-thebunner .active').next().find('.d-block').attr('src');
    var prev_src = $('.carousel-item.kenburn-slider-item').last().find('.d-block').attr('src');
    $('.carousel-control-prev-icon').css({
        "background-image": "url('" + prev_src + "')"
    });
    $('.carousel-control-next-icon').css({
        "background-image": "url('" + next_src + "')"
    });
    $('#carouselExampleFade').on('slid.bs.carousel', function() {
        var next_src = $('.carousel-inner.kenburn-slider-thebunner .active').next().find('.d-block').attr('src');
        if (next_src == undefined) {
            next_src = $('.carousel-item.kenburn-slider-item').first().find('.d-block').attr('src');
        }
        var prev_src = $('.carousel-inner.kenburn-slider-thebunner .active').prev().find('.d-block').attr('src');
        if (prev_src == undefined) {
            prev_src = $('.carousel-item.kenburn-slider-item').last().find('.d-block').attr('src');
        }
        $('.carousel-control-prev-icon').css({
            "background-image": "url('" + prev_src + "')"
        });
        $('.carousel-control-next-icon').css({
            "background-image": "url('" + next_src + "')"
        });
    })
</script>


<script>
    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;
        // Windows Phone must come first because its UA also contains "Android"
        if (/windows phone/i.test(userAgent)) {
            return "android";
        }
        if (/android/i.test(userAgent)) {
            return "android";
        }
        // iOS detection from: http://stackoverflow.com/a/9039885/177710
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "ios";
        }
        return "web";
    }

    if (getMobileOperatingSystem() != 'web') {
        $('#carouselExampleFade').hide();

        $.ajax({
            url: "{{ route('get_mobile_sliders' , ['locale' => app()->getLocale()])}}",
            type: "GET",
            cache: false,
            success: function(data) {
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                }
                // console.log(data);
                var banner = '';
                banner += `<ol class="carousel-indicators slider-dots">`;

                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    if (element?.mobile?.url) {
                        banner += `
                        <li data-target="#carouselExampleFade" data-slide-to=${index} class="slider-dots-item ${ index == 0 ? `active` : `` }"></li>
                        `;
                    }
                }

                banner += `}
                </ol>
                <div class="carousel-inner kenburn-slider-thebunner">`;

                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    if (element?.mobile?.url) {
                        banner += `
                        <div class="carousel-item kenburn-slider-item  ${ index == 0 ? 'active' : ''}">
                                <div class="slide-img">
                                    <img class="d-block w-100" src="${element.mobile.url}" alt="First slide">
                                </div>
                                <div class="container">
                                    <div class="our-nest-vesion">
                                        <span> test</span>
                                        <div class="data-vesion">
                                            .... <em>2030</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    }
                }

                banner += `
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                `;

                $('#carouselExampleFade').html(banner);
                $('#carouselExampleFade').show();

            },
            error: function() {},
            complete: function() {},
        });
    }

    // if (getMobileOperatingSystem() != 'web') {
    //     $('#carousel_mobile').hide();

    //     $.ajax({
    //         url: "{{ route('get_mobile_sliders' , ['locale' => app()->getLocale()])}}",
    //         type: "GET",
    //         cache: false,
    //         success: function(data) {
    //             for (let index = 0; index < data.length; index++) {
    //                 const element = data[index];

    //             }
    //             // console.log(data);
    //             var banner = '';
    //             banner += `
    //                 <div class="owl-carousel">
    //             `

    //             for (let index = 0; index < data.length; index++) {
    //                 const element = data[index];
    //                 if (element?.mobile?.url) {
    //                     banner += `
    //                         <div class="item">
    //                             <div class="slide-img">
    //                                 <img class="d-block w-100" src="${element.mobile.url}" alt="First slide">
    //                             </div>
    //                             <div class="container">
    //                                 <div class="our-nest-vesion">
    //                                     <span> test</span>
    //                                 </div>
    //                                 <div class="data-vesion">
    //                                     .... <em>2030</em>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     `;
    //                 }
    //             }
    //             banner += `
    //                 </div>
    //             `

    //             $('#carousel_mobile').html(banner);
    //             $('#carousel_mobile').show();

    //         },
    //         error: function() {},
    //         complete: function() {},
    //     });
    // }

</script>
@endsection
@section('styles')

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><link rel="stylesheet" type="text/css" href="/frontend/css/slick-theme.css" />
@endsection
