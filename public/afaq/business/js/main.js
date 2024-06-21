$(function () {

    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.header-').addClass('fixed-header');
            } else {
                $('.header-').removeClass('fixed-header');
            }
        });
    });
    $('.afq-statistics-slider.owl-carousel').owlCarousel({
        loop: true,
        margin: 20,
        autoplay: true,
        nav: true,

        pagination: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        dots: false,
        // autoWidth: true,
        // items: 2,
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true,
                autoWidth: true,
                center:true
            },
            600: {
                items: 2,
                nav: false,
                dots: true,
                autoWidth: true,
                center:true
            },
            1000: {
                items: 2,
                dots: true,
            }
        }
    })

    $('.Our-Clients-slider.owl-carousel').owlCarousel({
        loop: false,
        margin: 20,
        // center: true,
        nav: true,
        autoplay: true,
        pagination: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        dots: false,
        autoWidth: true,
        items: 4,
        responsive: {
            0: {
                loop: true,
                center: true,
                items: 1,
                nav: false,
                dots: true,
                autoWidth: true,
            },
            600: {
                loop: true,
                center: true,
                items: 1,
                nav: false,
                dots: true,
                autoWidth: true,
            },
            1000: {
                items: 2,
                dots: true,
            }
        }

    })

    $('.afa-details-slider.owl-carousel').owlCarousel({
        loop: true,
        center: true,
        margin: 10,
        nav: false,
        autoplay: true,
        pagination: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        dots: false,
        autoWidth: true,
        items: 1,

    })

    $('.appropriate-package-slider.owl-carousel').owlCarousel({
        loop: false,
        // center: true,
        margin: 10,
        nav: false,
        pagination: true,
        autoplay: false,
        autoplayTimeout: 3000,
        responsiveClass: true,
        dots: false,
        autoWidth: true,
        items: 1,

    })

    $('.carusel-sec-img.owl-carousel').owlCarousel({
        rtl: true,
        loop: true,
        center: true,
        margin: 10,
        nav: false,
        pagination: true,
        autoplayTimeout: 2500,
        responsiveClass: true,
        autoplay: true,
        dots: true,
        autoWidth: true,
        items: 1,

    })

    $('.carusel-one-img.owl-carousel').owlCarousel({
        loop: true,
        center: true,
        margin: 10,
        nav: false,
        pagination: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        autoplay: true,
        dots: true,
        autoWidth: true,
        items: 1,
        responsive: {
            0: {
                loop: true,
                center: true,
                items: 1,
                nav: false,
                dots: true,
                autoWidth: false,
            },
            600: {
                loop: true,
                center: true,
                items: 1,
                nav: false,
                dots: true,
                autoWidth: false,
            },
            1000: {
                items: 2,
                dots: true,
            }
        }

    })

    $(".owl-prev").html('<i class="fa-solid fa-chevron-left"></i>');
    $(".owl-next").html('<i class="fa-solid fa-chevron-right"></i>');
    $(".uk-position-center-left.uk-position-small").html('<i class="fa-solid fa-chevron-left"></i>');
    $(".uk-position-center-right.uk-position-small").html('<i class="fa-solid fa-chevron-right"></i>');
    $(".rtl .upload-button span").html('تحميل المرفق')
    $(".ltr .upload-button span").html('Upload Image')
    $(".upload-button i::before").html('.')

    $(".the-work-time span").click(function () {
        $(this).addClass("active")
        $(this).siblings().removeClass("active")
    })
    $(".menu-bar").click(function () {
        $(".side-nav-bar").addClass("active")
    })
    $(".close-side-nave").click(function () {
        $(".side-nav-bar").removeClass("active")
    })
    $(".list-log_").click(function () {
        $(".drop-dawn-user-list").toggleClass("active")
        $(".notifc-card-nd_").toggleClass("active")
    })
    $(".notifc-card-nd_").click(function () {
        $(this).removeClass("active")
        $(".drop-dawn-user-list").removeClass("active")
    })
    $(".user-name-details").click(function () {
        $(".next-popup-user-details").addClass("active")
    })
    $(".back-sec").click(function () {
        $(".next-popup-user-details").removeClass("active")
    })
    $(".col-package-page").click(function () {
        $(".pal-inner").toggleClass("active")
        $(this).siblings().find(".pal-inner").removeClass("active")
    })

});
function goToApp() {
    switch (getMobileOperatingSystem()) {
        case 'ios':
            var url = "https://apps.apple.com/eg/app/afaq-%D8%A2%D9%81%D8%A7%D9%82/id6444857032";
            // var url = "https://tools.applemediaservices.com/";
            break;
        case 'android':
            var url = "https://play.google.com/store/apps/details?id=com.afaq.application&pli=1";
            break;
        case 'web':
            var url = "https://afaq.myevntoo.info/ar";
            break;
        default:
            var url = "https://afaq.myevntoo.info/";
            break;

    }

    console.log(url)
    window.location = url;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#file_upload')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);

    }
    $.ajax({
        type: 'POST',
        url: "{{ route('update_personal_photo')}}",
        data: reader,
        cache: false,
        contentType: false,
        processData: false,
        success: (response) => {
            console.log(response);
            $('#personal_img').attr('src', response);

        }
    })

}
// $(".user-name.list-log_").click(function () {
//     $(".drop-dawn-user-list").toggleClass("active")
//     $(".notifc-card-nd_").toggleClass("active")
// })
//
// $(".notifc-card-nd_").click(function () {
//     $(this).removeClass("active")
//     $(".drop-dawn-user-list").removeClass("active")
// })
// Arafa *******************

$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(".afaq-acc-name").click(function () {
    $(this).addClass("active")
    $(this).siblings().removeClass("active")
})

$(".afaq-acc-name.my-acc").click(function () {
    $(".acc-detials-form.my-acc-form").addClass("show")
    $(".acc-detials-form.Packages-form").removeClass("show")
    $(".acc-detials-form.Invoices-form").removeClass("show")
    $(".acc-detials-form.Tickets-form").removeClass("show")
})
$(".afaq-acc-name.Packages").click(function () {
    $(".acc-detials-form.Packages-form").addClass("show")
    $(".acc-detials-form.my-acc-form").removeClass("show")
    $(".acc-detials-form.Invoices-form").removeClass("show")
    $(".acc-detials-form.Tickets-form").removeClass("show")
})
$(".afaq-acc-name.Invoices").click(function () {
    $(".acc-detials-form.Invoices-form").addClass("show")
    $(".acc-detials-form.my-acc-form").removeClass("show")
    $(".acc-detials-form.Packages-form").removeClass("show")
    $(".acc-detials-form.Tickets-form").removeClass("show")
})
$(".afaq-acc-name.Tickets").click(function () {
    $(".acc-detials-form.Tickets-form").addClass("show")
    $(".acc-detials-form.my-acc-form").removeClass("show")
    $(".acc-detials-form.Packages-form").removeClass("show")
    $(".acc-detials-form.Invoices-form").removeClass("show")
})
$(".add-tickets").click(function () {
    $(".ticket-creat").addClass("active")

})
$(".fk-layer-ticket").click(function () {
    $(".ticket-creat").removeClass("active")
})
$(".close-ticket i").click(function () {
    $(".ticket-creat").removeClass("active")
})


$(".body-tick").click(function () {
    var div_id = $(this).attr('data-id');
    $(`.ticket-opened-${div_id}`).addClass("active")
})
$(".fk-layer-ticket").click(function () {
    $(".ticket-opened").removeClass("active")
})
$(".close-ticket i").click(function () {
    $(".ticket-opened").removeClass("active")
})

$(".sm-creat-reblay").click(function () {
    $(".ticket-opened").removeClass("active")
    $(".ticket-replay").addClass("active")
})
$(".fk-layer-ticket").click(function () {
    $(".ticket-replay").removeClass("active")
})
$(".close-ticket i").click(function () {
    $(".ticket-replay").removeClass("active")
})
$(".Cancel-last").click(function(){
    $(".ticket-creat").removeClass("active")
    $(".ticket-opened").removeClass("active")
    $(".ticket-replay").removeClass("active")
})
$(".ltr .upload-button span").html('UPLOAD IMAGE')
$(".rtl .upload-button span").html('تحميل المرفق')

//************************
var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    //   breakpoints: {
    //     640: {
    //       slidesPerView: 2,
    //       spaceBetween: 20,
    //     },
    //     768: {
    //       slidesPerView: 2,
    //       spaceBetween: 20,
    //     },
    //     1024: {
    //       slidesPerView: 3,
    //       spaceBetween: 30,
    //     },
    //   },
});
