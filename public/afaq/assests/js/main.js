$(function () {
    if (localStorage.getItem('the-get-app-btn') == 'active') {
        $('.the-get-app-btn').addClass('active');
        $('.the-get-app-btn').siblings(".header.col-12.ssd").addClass("new-active")
        $(".single-header").addClass("new-active");
    }
    if (localStorage.getItem('marque-') == 'active') {
        $(".marque-").addClass("remove")
    }
    $(window).resize(function () {
        if ($(window).width() < 600) {
            $('.ltr.course_content_right_sections_on_small_screen').owlCarousel({
                loop: false,
                autoWidth: true,
                nav: false,
                rtl: false,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            })
        }
    });
    if ($(window).width() < 600) {
        $('.ltr.course_content_right_sections_on_small_screen').owlCarousel({
            loop: false,
            autoWidth: true,
            nav: false,
            rtl: false,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        })
    }
    $(window).resize(function () {
        if ($(window).width() < 600) {
            $('.rtl.course_content_right_sections_on_small_screen').owlCarousel({
                loop: false,
                rtl: true,
                autoWidth: true,
                nav: false,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            })
        }
    });
    if ($(window).width() < 600) {
        $('.rtl.course_content_right_sections_on_small_screen').owlCarousel({
            loop: false,
            rtl: true,
            autoWidth: true,
            nav: false,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        })
    }
    $('.bunner_slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: true,
        margin: 10,
        nav: true,
        // center:true,
        dots: false,
        // autoWidth:true,
        items: 1,
    })
    $('.Recorded_slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        items: 3,
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            600: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 3,
            }
        }
    })

    $('.slider-section-activities.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        items: 3,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            600: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 3,
            }
        }
    })
    $('.filtr-slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        items: 3,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            600: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 3,
            }
        }
    })
    $('.Trusted-By-logo.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 25,
        nav: true,
        dots: false,
        responsiveClass: true,
        items: 6,
        autoWidth: true,
        responsive: {
            0: {
                items: 1,
                margin: 5,
                nav: false,
            },
            600: {
                items: 1,
                margin: 5,
                nav: false,
            },
            1000: {
                items: 4,
            }
        }
    })
    $('.Recently_slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: true,
        margin: 10,
        nav: true,
        pagination: true,
        autoplayTimeout: 6000,
        responsiveClass: true,
        dots: false,
        items: 3,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 3,
            }
        }
    })

    $('.card-Success-data.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 16,
        nav: false,
        dots: false,
        items: 3,
        autoWidth: true,
        // URLhashListener:true,
        // autoplayHoverPause:true,
        // startPosition: 'URLHash',
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            600: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 3,
            }
        }
    })
    $('.Quick-Access-slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 25,
        nav: false,
        dots: false,
        responsiveClass: true,
        items: 6,
        autoWidth: true,
        responsive: {
            0: {
                items: 3,
                margin: 25,
            },
            600: {
                items: 3,
                margin: 25,
            },
            1000: {
                items: 6,
            }
        }
    })
    $('.Afaq-Statistics-slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 15,
        nav: false,
        dots: false,
        items: 5,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true
            },
            600: {
                items: 2,
                dots: false,
                nav: false,
                autoWidth: true
            },
            1000: {
                items: 4,
            }
        }
    })
    $('.slider-filtter-activities.owl-carousel').owlCarousel({
        // rtl: langRtl ? true : false,
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        // responsiveClass: true,
        // items: 3,
        autoWidth: true,



    })
    $('.tabs-section-carousel.owl-carousel').owlCarousel({
        // rtl: langRtl ? true : false,
        loop: false,
        margin: 15,
        nav: false,
        dots: false,
        autoWidth: true,
        // items: 7,
        responsive: {
            0: {
                // items: 2,
                dots: true,
                nav: false,
            },
            600: {
                // items: 3,
                dots: true,
                nav: false,
            },
            1000: {
                items: 5,
            }
        }
    })
    $('.organizer-nd-card.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 15,
        nav: false,
        dots: false,
        autoWidth: true,
        items: 4,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false,
            },
            600: {
                items: 2,
                dots: true,
                nav: false,
            },
            1000: {
                items: 4,
            }
        }
    })
    $('.Also-Brought-card.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 15,
        nav: false,
        dots: false,
        autoWidth: true,
        // items: 3,
        responsive: {
            0: {
                // items: 1,
                dots: true,
                nav: false,
                autoWidth: true,
            },
            600: {
                // items: 2,
                dots: true,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 3,
                autoWidth: true,
            }
        }
    })
    $('.slider_cours_details_.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        // autoWidth:true,
        items: 1,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false,
            },
            600: {
                items: 1,
                dots: true,
                nav: false,
            },
            1000: {
                items: 1,
            }
        }
    })

    $('.Specialist-table.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 25,
        nav: false,
        dots: false,
        responsiveClass: true,
        items: 5,
        autoWidth: true,
        responsive: {
            0: {
                items: 4,
                margin: 5,
            },
            600: {
                items: 4,
                margin: 5,
            },
            1000: {
                items: 5,
            }
        }
    })
    // ************************ profile***********
    $('.profiledetails.owl-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: false,
        dots: false,
        // autoWidth:true,
        items: 2,
        responsive: {
            0: {
                items: 2,
                dots: true,
                nav: false,
                autoWidth: true,
            },
            600: {
                items: 2,
                dots: true,
                nav: false,
                autoWidth: true,
            },
            1000: {
                items: 2,
            }
        }
    })
    // $("#mobile_code").intlTelInput({
    //     initialCountry: "sa",
    //     separateDialCode: true,
    //     // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    // });
    // ************************ faq********
    $('.faqs-slider.owl-carousel').owlCarousel({
        rtl: langRtl ? true : false,
        loop: false,
        margin: 25,
        nav: false,
        dots: false,
        responsiveClass: true,
        items: 5,
        autoWidth: true,
        responsive: {
            0: {
                items: 4,
                margin: 5,
            },
            600: {
                items: 4,
                margin: 5,
            },
            1000: {
                items: 5,
            }
        }
    })
    // **********************************
    $(".notifc-option").click(function () {
        $(".option-notifcation-").toggleClass("show")
        $(this).parent().parent().siblings().find(".option-notifcation-").removeClass("show")
    })
    $(".read-massage").click(function () {
        $("ul.notification-listed>li").addClass("read-done")

        $(".read-mark").addClass("show")
    })
    $(".mark-delets").click(function(){
        $(this).parent().parent().parent().parent().toggleClass("hide")
    })
    // ***********************
    $(".owl-prev").html('<i class="fa-solid fa-caret-left"></i>');
    $(".owl-next").html('<i class="fa-solid fa-caret-right"></i>');
    $(".bunner_slider.owl-carousel .owl-prev ").html('<i class="fa-solid fa-chevron-right"></i>');
    $(".bunner_slider.owl-carousel .owl-next ").html('<i class="fa-solid fa-chevron-left"></i>');
    $(".rtl .upload-button span").html('تحميل المرفق')
    $(".ltr .upload-button span").html('Upload Image')
    $(".upload-button i::before").html('.')
    // *************** end carusel-js *****************************
    $(document).ready(function () {
        // $(".search-bnt").click(function () {
        //     $(".search-popup").toggleClass("active");
        // });
        $(".close-icon").click(function () {
            $(".search-popup").removeClass("active");
        })
        $(".btn-filter-activities").click(function () {
            $(this).addClass("active");
            $(this).parent().siblings().find(".btn-filter-activities").removeClass("active")
        })
        $(".read-more").click(function () {
            $(this).removeClass("active");
            $(".answer-list").addClass("show");
            $(".read-less").addClass("active");
        })
        $(".read-less").click(function () {
            $(this).removeClass("active");
            $(".answer-list").removeClass("show");
            $(".read-more").addClass("active");
        })
        $(".course-time-head").click(function () {
            $(".section-time-content").toggleClass("active");
            $(this).parent().siblings().find(".section-time-content").removeClass("active")
        })
        $(".buger-small-meu").click(function () {
            $(".set-menu-bar").toggleClass("active")
        })
        $(".open-sub-cat").click(function () {
            $(".sub-small-menu-bar").toggleClass("active")
        })
        $(".wish-list").click(function () {
            $(this).toggleClass("onactive")
        })
        $(".wish-list-row").click(function () {
            $(this).toggleClass("onactive")
        })
        $(".wishlist-nd i").click(function () {
            $(this).addClass("remove");
            $(this).removeClass("active");
            $(".wishlist-nd img").addClass("active")
            $(".wishlist-nd img").removeClass("remove")
        })
        $(".wishlist-nd img").click(function () {
            $(this).removeClass("active");
            $(this).addClass("remove");
            $(".wishlist-nd i").addClass("active")
        })
        $(".the-course-time span").click(function () {
            $(".section-time-content").toggleClass("on-the-active")
            $(".section-time-content").removeClass("active")
        })
        $(".the-course-time .Expand").click(function () {
            $(this).removeClass("active")
            $(".Collaps").addClass("active")
        })
        $(".the-course-time .Collaps").click(function () {
            $(this).removeClass("active")
            $(".Expand").addClass("active")
        })
        $(".all-tabs-section span").click(function () {
            $(this).addClass("active");
            $(this).siblings().removeClass("active")
        })
        // $(".new-price-avilable").click(function() {
        //     // $(this).addClass("active");
        //     $(this).parent(".new-price-lms").parent(".box_lms").siblings().find(".new-price-avilable").removeClass("active")
        // })
        $(".next_btn_").click(function () {
            var form = $(this).parent('#formABC');

            if (
                $('input[name="full_name_ar"]').val() &&
                $('input[name="full_name_en"]').val() &&
                $('select[name="name_title"]').val() &&
                $('select[name="gender"]').val() &&
                $('select[name="nationality_id"]').val()) {
                $(this).addClass("not-now");
                $(".Personaldata-details-account").addClass("not-now");
                $(".Account_details").addClass("active");
                $(".details-account-register").removeClass("not-now");
                $(".creat-new-acc").removeClass("not-now");
                $(".termis-line").removeClass("not-now");
            } else {
                form.validate();
            }
        })
        // $(".accordion-btn").click(function() {
        //     $(this).toggleClass("active")
        //     $(this).siblings().removeClass("active")
        // })
        // ******************** show pass*******************
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        // new edite
        $(".all-tabs-section span.item").click(function () {
            $(this).addClass("active");
            $(this).parent().siblings().find("span.item").removeClass("active")
        })

        $(".o_expand").click(function () {
            $(this).removeClass("active")
            $(".o_collaps").addClass("active")
            $(".section-work.one").removeClass("active")
        })
        $(".o_collaps").click(function () {
            $(this).removeClass("active")
            $(".o_expand").addClass("active")
            $(".section-work.one").addClass("active")
        })
        // **********************
        $(".t_expand").click(function () {
            $(this).removeClass("active")
            $(".t_collaps").addClass("active")
            $(".section-work.two").removeClass("active")
        })
        $(".t_collaps").click(function () {
            $(this).removeClass("active")
            $(".t_expand").addClass("active")
            $(".section-work.two").addClass("active")
        })
        // **********************
        $(".th_expand").click(function () {
            $(this).removeClass("active")
            $(".th_collaps").addClass("active")
            $(".section-work.Third").removeClass("active")
        })
        $(".th_collaps").click(function () {
            $(this).removeClass("active")
            $(".th_expand").addClass("active")
            $(".section-work.Third").addClass("active")
        })
        // **********************
        $(".f_expand").click(function () {
            $(this).removeClass("active")
            $(".f_collaps").addClass("active")
            $(".section-work.four").removeClass("active")
        })
        $(".f_collaps").click(function () {
            $(this).removeClass("active")
            $(".f_expand").addClass("active")
            $(".section-work.four").addClass("active")
        })
        $(".tabby-termise").click(function () {
            $(".tabby-popup").addClass("active")
        })
        $(".close-tabby").click(function () {
            $(".tabby-popup").removeClass("active")
        })
        // ************************** js for search result *******************
        $(".filtter-title").click(function () {
            $(this).toggleClass("active")
            $(this).parent(".all-filtter-data ").siblings().find(".filtter-title").removeClass("active")
            $(".filtter-details").toggleClass("active")
            $(this).parent(".all-filtter-data ").siblings().find(".filtter-details").removeClass("active")

            // $(".filtter-icon .down").toggleClass("active")
            // $(".filtter-icon .up").toggleClass("active")

        })
        $(".list-pages ul li").click(function () {
            $(this).addClass("active")
            $(this).siblings().removeClass("active")
        })
        $(".filtter-btn").click(function () {
            $(".search-type-list").addClass("active")
        })
        $(".close-filtter-btn").click(function () {
            $(".search-type-list").removeClass("active")
        })


        $(".list-pages ul li").click(function () {
            $(this).addClass("active")
            $(this).siblings().removeClass("active")
        })
        $(".filtter-btn").click(function () {
            $(".search-type-list").addClass("active")
        })
        $(".close-filtter-btn").click(function () {
            $(".search-type-list").removeClass("active")
        })
        $(".payment-img").click(function () {
            $(this).addClass("active")
            $(this).siblings().removeClass("active")
        })

        $(".payment-img.bank").click(function () {
            $(".the-payment-details.the-bank").addClass("active")
            $(".the-payment-details.the-appelway").removeClass("active")
            $(".the-payment-details.the-visa").removeClass("active")
        })

        $(".payment-img.appel").click(function () {
            $(".the-payment-details.the-appelway").addClass("active")
            $(".the-payment-details.the-bank").removeClass("active")
            $(".the-payment-details.the-visa").removeClass("active")
        })

        $(".payment-img.visa").click(function () {
            $(".the-payment-details.the-visa").addClass("active")
            $(".the-payment-details.the-appelway").removeClass("active")
            $(".the-payment-details.the-bank").removeClass("active")
        })
        $(".notifcations-btn").click(function () {
            $(".popup-notic-card").toggleClass("active")
            $(".notifc-card-nd").toggleClass("active")
            $(".drop-dawn-user-list").removeClass("active")
            $(".notifc-card-nd_").removeClass("active")
        })
        $(".notifc-card-nd").click(function () {
            $(this).removeClass("active")
            $(".popup-notic-card").removeClass("active")
        })
        $(".notifc-card-nd_").click(function () {
            $(this).removeClass("active")
            $(".drop-dawn-user-list").removeClass("active")
        })
        $(".close-burger-men_list").click(function () {
            $(this).parent(".set-menu-bar").removeClass("active")
        })
        $(".in-personal-details").click(function () {
            $(".small-drop-menu-personal").toggleClass("active")
            $(".drowp-dawn-icon-btn").toggleClass("active")
        })
        $(".lang-sub-lms").click(function () {
            $(".sm-sub-lang-").toggleClass("active")
        })
        $(".get-app-link").click(function () {
            $(".all-link-app").toggleClass("active")
        })
        // ************ end search result*************
        $(".list-log_").click(function () {
            $(".drop-dawn-user-list").toggleClass("active")
            $(".popup-notic-card").removeClass("active")
            $(".notifc-card-nd").removeClass("active")
            $(".notifc-card-nd_").toggleClass("active")
        })
        // $(".the-cart-setion").click(function () {
        //     $(".cart-popup-setion").toggleClass("active")
        // })

        $(".canel-reson-nd span").click(function () {
            $(".nd-cancel-reservation-course").addClass("active")
        })
        $(".close-popup-icon").click(function () {
            $(".nd-cancel-reservation-course").removeClass("active")
        })
        $(".close-setion-lms").click(function () {
            $(this).parent(".get-app-afaqlogo_").parent(".getapp-data").parent(".get-app-section").parent('.the-get-app-btn').addClass("active")
            localStorage.setItem("the-get-app-btn", "active")
            $(this).parent(".get-app-afaqlogo_").parent(".getapp-data").parent(".get-app-section").parent('.the-get-app-btn').siblings(".header.col-12.ssd").addClass("new-active")
            $(this).parent(".get-app-afaqlogo_").parent(".getapp-data").parent(".get-app-section").parent('.the-get-app-btn').parent(".single-header").addClass("new-active")


        })

        $(".all-qs-afaq").click(function () {
            $(this).toggleClass("active")
            $(this).siblings().removeClass("active")
        })
        $(".title-wallet").click(function () {
            $(this).addClass("active")
            $(this).siblings().removeClass("active")
        })
        $(".act-wallet-section").click(function () {
            $(".wallet-section").addClass("active")
            $(".points-section").removeClass("active")
        })
        $(".act-points-sections").click(function () {
            $(".wallet-section").removeClass("active")
            $(".points-section").addClass("active")
        })
        $(".InviteFriends").click(function () {
            $(".InviteFriends-popup").addClass("active")
        })
        $(".close-window").click(function () {
            $(".InviteFriends-popup").removeClass("active")
        })
        $(".fk-popup").click(function () {
            $(".InviteFriends-popup").removeClass("active")
        })

        $(".creat-ticket").click(function () {
            $(".new-ticket").addClass("active")
        })
        $(".fk-layer").click(function () {
            $(".new-ticket").removeClass("active")
            $(".open-ticket-card").removeClass("active")
            $(".creat-reblay-popup").removeClass("active")
        })
        $(".close-tickett").click(function () {
            $(".new-ticket").removeClass("active")
            $(".open-ticket-card").removeClass("active")
            $(".creat-reblay-popup").removeClass("active")
        })
        $(".Cancel-last").click(function () {
            $(".new-ticket").removeClass("active")
            $(".open-ticket-card").removeClass("active")
            $(".creat-reblay-popup").removeClass("active")
        })
        $(".the-problem-ticket").click(function () {
            var div_id = $(this).attr('data-id');
            $(`.open-ticket-card-${div_id}`).addClass("active")
        })
        $(".creat-reblay").click(function () {
            $(".creat-reblay-popup").addClass("active")
            $(".open-ticket-card").removeClass("active")
        })
        $(".user-name-details").click(function () {
            $(".next-popup-user-details").addClass("active")
        })
        $(".back-sec").click(function () {
            $(".next-popup-user-details").removeClass("active")
        })

        // $(".n-one-tabe").click(function () {
        //     $(".tabes-qusetions.one-tabe").removeClass("active")
        //     $(".tabes-qusetions.two-tab").addClass("active")
        // })
        // $(".b-two-tabe").click(function () {
        //     $(".tabes-qusetions.one-tabe").addClass("active")
        //     $(".tabes-qusetions.two-tab").removeClass("active")
        // })
        // // *********************
        // $(".n-two-tabe").click(function () {
        //     $(".tabes-qusetions.two-tab").removeClass("active")
        //     $(".tabes-qusetions.three-tab").addClass("active")
        // })
        // $(".b-three-tabe").click(function () {
        //     $(".tabes-qusetions.two-tab").addClass("active")
        //     $(".tabes-qusetions.three-tab").removeClass("active")
        // })
        // // *********************
        // $(".n-three-tabe").click(function () {
        //     $(".tabes-qusetions.three-tab").removeClass("active")
        //     $(".tabes-qusetions.four-tabe").addClass("active")
        // })
        // $(".b-four-tabe").click(function () {
        //     $(".tabes-qusetions.three-tab").addClass("active")
        //     $(".tabes-qusetions.four-tabe").removeClass("active")
        // })
        $(".fk-popup-").click(function () {
            $(".modal-Checkout-lms.condations-nd").removeClass("active")
        })
        $(".close-marq").click(function () {
            $(".marque-").addClass("remove")
            localStorage.setItem("marque-", "active")
        })
        // ******************* stepper js *****************
        $('.n-one-tabe').click(function () {
            $(this).parent().parent().hide().next().show();//hide parent and show next
        });

        $('.b-one-tabe').click(function () {
            $(this).parent().parent().hide().prev().show();//hide parent and show previous
        });
        // $(".remov-act").click(function(){
        //     $(".all-thesteps").siblings().prev().addClass("act-active")
        //     $(".all-thesteps").siblings().removeClass("act-active")
        // })
        // ******************* stepper js *****************
        //******************** jq ahmed 3rafa*********************

        // ******************** jq ahmed 3rafa*********************


        $(".open-termis").click(function () {
            // $(this).toggleClass("a7a")
            $(".modal-Checkout-lms").addClass("active")

        })
        $(".close-icons").click(function () {
            $(".modal-Checkout-lms").removeClass("active")
        })


        // ************************** smooth scroll js one course page *************************
        $(".Introductions-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".Introductions_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".Descriptions-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".Descriptions_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".Accreditations-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".Accreditations_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".early_booking-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".early_booking_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".CourseContents-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".CourseContents_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".TargetAudience-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".the-TargetAudience_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        $(".AboutInstructors-btn").click(function () {
            $('html,body').animate({
                scrollTop: $(".AboutInstructors_lms").offset().top - 156 + 'px'
            },
                'slow');
        });
        // ************************** smooth scroll js one course page *************************
    });
});

// });
// ***********************************************************
// Set the date we're counting down to
// var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
//
// // Update the count down every 1 second
// var x = setInterval(function () {
//
//     // Get today's date and time
//     var now = new Date().getTime();
//
//     // Find the distance between now and the count down date
//     var distance = countDownDate - now;
//
//     // Time calculations for days, hours, minutes and seconds
//     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//
//     // Output the result in an element with id="demo"
//     // document.getElementById("days").innerHTML = days;
//     // document.getElementById("hrs").innerHTML = hours;
//     // document.getElementById("mins").innerHTML = minutes;
//     //   document.getElementById("sec").innerHTML = seconds + "s ";
//
//     // If the count down is over, write some text
//     if (distance < 0) {
//         clearInterval(x);
//         document.getElementById("days").innerHTML = "EXPIRED";
//     }
// }, 1000);
// ************************* tel *******************************
// Make sure to place this snippet in the footer or at least after
// the HTML input we're targeting.

$(document).ready(function () {
    var phoneInputID = "#phone";
    var input = document.querySelector(phoneInputID);
    var iti = window.intlTelInput(input, {
        allowExtensions: true,
        formatOnDisplay: true,
        autoFormat: true,
        autoHideDialCode: true,
        autoPlaceholder: true,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        hiddenInput: "full_number",

        numberType: "MOBILE",
        nationalMode: true,
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ["sa", "ae", "eg", "qa", "om", "bh", "kw", "ma"],
        preventInvalidNumbers: true,
        separateDialCode: true,
        initialCountry: "sa",
        geoIpLookup: function (callback) {
            $.get("http://ipinfo.io", function () { }, "jsonp").always(function (resp) {
                var countryCode = resp && resp.country ? resp.country : "";
                callback(countryCode);
            });
        },
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
        utilsScript: "/intl-tel-input/js/utils.js?1707906286003" // just for formatting/placeholders etc

        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: true,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['es'],
        // separateDialCode: true,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
    });
    // const handleChange = () => {
    //     let text;
    //     if (input.value) {
    //         text = iti.isValidNumber()
    //             ? "Valid number! Full international format: " + iti.getNumber()
    //             : "Invalid number - please try again";
    //     } else {
    //         text = "Please enter a valid number below";
    //     }
    //     const textNode = document.createTextNode(text);
    //     output.innerHTML = "";
    //     output.appendChild(textNode);
    // };

    $(phoneInputID).on("countrychange", function (event) {

        // Get the selected country data to know which country is selected.
        var selectedCountryData = iti.getSelectedCountryData();

        // Get an example number for the selected country to use as placeholder.
        newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

            // Reset the phone number input.
            iti.setNumber("");

        // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
        mask = newPlaceholder.replace(/[1-9]/g, "0");

        // Apply the new mask for the input
        $(this).mask(mask);
    });


    // When the plugin loads for the first time, we have to trigger the "countrychange" event manually,
    // but after making sure that the plugin is fully loaded by associating handler to the promise of the
    // plugin instance.

    iti.promise.then(function () {
        $(phoneInputID).trigger("countrychange");
    });

});
// *********************************************************
$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.header').addClass('fixed-header');
    } else {
        $('.header').removeClass('fixed-header');
    }
});
$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $('.stick-tabs-afaq').addClass('active-sec');
        $('.heade-width.on-small-screen').addClass('set-active')
    } else {
        $('.stick-tabs-afaq').removeClass('active-sec');
        $('.heade-width.on-small-screen').removeClass('set-active')
    }
});

// $(window).scroll(function() {
//     if ($(this).scrollTop() > 4500) {
//         $('.MessageUs-btn').addClass('fixed-MessageUs-btn');
//     } else {
//         $('.MessageUs-btn').removeClass('fixed-MessageUs-btn');
//     }
// });
// var mixer = mixitup("#detailscardactivities");
// // var mixer = mixitup(containerEl);
// var mixer = mixitup(containerEl, {
//     selectors: {
//         target: ".blog-item",
//     },
//     load: {
//         filter: '.All-Categories'
//     },
//     controls: {
//         toggleDefault: 'All-Categories'
//     },
//     animation: {
//         duration: 300,
//     },
// });
// *********************************
function show_card_details(card) {
    var body_rect = document.body.getBoundingClientRect(),
        body_width = document.body.clientWidth,
        card_position = card.getBoundingClientRect(),
        card_width = card.clientWidth,
        offset = card_position.left - body_rect.left,
        screen_center = body_width / 2,
        card_end_point = offset + card_width,
        card_right = false,
        prev = card.previousElementSibling;


    if (card_end_point > screen_center) {
        card_right = true;
        // console.log(card.children[2]);
        card.children[2].classList.add('changed');

        card.children[2].style.transition = 'none';
        card.children[2].style.height = 'auto';
        card.children[2].style.right = '100%';
    } else {
        card_right = false;
        card.children[2].classList.remove('changed');

        card.children[2].style.transition = 'none';
        card.children[2].style.height = 'auto';
        card.children[2].style.left = '100%';
    }
    // card.children[2].style.transition = '0.2s';
    card.children[2].style.width = '100%';
    card.children[2].style.opacity = '1';
    card.children[2].style.zIndex = '1';
    card.children[2].style.overflow = 'visible';

}

function hide_card_details(card) {
    // card.children[2].style.transition = 'none';
    card.children[2].style.width = '0';
    card.children[2].style.height = '0';
    card.children[2].style.opacity = '0';
    // card.children[2].style.zIndex = '0';
    card.children[2].style.overflow = 'hidden';

}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

// ***********************************

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
console.log(getMobileOperatingSystem());
// window.location = 'evntoo://app';
// switch (getMobileOperatingSystem()) {
//     case 'ios':
//         var url = "https://apps.apple.com/us/app/evntoo/id1576667823";
//         break;
//     case 'android':
//         var url = "https://play.google.com/store/apps/details?id=com.evntoo";
//         break;
//     case 'web':
//         var url = "https://afaq.myevntoo.info/ar";
//         break;
//     default:
//         var url = "https://afaq.myevntoo.info/";
//         break;
// }
// setTimeout(function() {
//     console.log(url);
//     window.location = url;
// }, 1000);
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
            var url = "https://afaq-lms.com/ar";
            break;
        default:
            var url = "https://afaq-lms.com/";
            break;

    }

    console.log(url)
    window.location = url;
}
$(window).on('load', function() {
    $(".application-linkes").addClass("active")
})
// *******************************
if (localStorage.getItem('application-linkes') == 'active') {
    $(".application-linkes").addClass("remove")
}
$(".close-window").click(function () {
    $(".application-linkes").addClass("remove")
    localStorage.setItem("application-linkes", "active")
})
// *****************************

// $(".close-window").click(function(){
//     $(".application-linkes").removeClass("active")
// })
