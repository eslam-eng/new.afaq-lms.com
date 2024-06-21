$(function () {
  $(document).ready(function () {
    $(".nav-menu").click(function () {
      $(".new-small-menu").toggleClass("down");
    });
  });

  $(".search-toggler").click(function () {
    $(".open-search-box").toggleClass("open-box");
  })
  $('.method').click(function(){
    $(this).addClass('activemethod');
    $(this).siblings().removeClass('activemethod')
  })
  $(".close-icon-").click(function () {
    $(".close-icon-").removeClass("open-box");
  })
  $(".btn-dropdown").click(function () {
    $(".dropdown-menu-sna").toggleClass("show-dropdown")
    $(".overlay-sna").toggleClass("show-overlay")
  })
  $(".stm-lms-snacoursgoals").click(function () {
    $(".stm-lms-snatitle").toggleClass("active")
    $(".lms-snacoursgoals-all").toggleClass("show-active")
    $(this).siblings().find(".lms-snacoursgoals-all").removeClass("show-active")
    $(this).siblings().find(".stm-lms-snatitle").removeClass("active")
  })
  $(".overlay-sna").click(function () {
    $(this).toggleClass("show-overlay")
    $(".dropdown-menu-sna").removeClass("show-dropdown")
  })
  // *************************************************
  $(".notifcation-icon").click(function () {
    $(".overlaytwo-sna").toggleClass("show-active")
    $(".notifcation-itemm-list").toggleClass("show-item-box")
  })
  $(".overlaytwo-sna").click(function () {
    $(this).removeClass("show-active")
    $(".notifcation-itemm-list").removeClass("show-item-box")
  })
  // **************************************************
  $(".item-list-notifcation").click(function () {
    $(".notifcation-itemm-list").toggleClass("activ-notifcation-itemm-list")
    $(".overlaytwo-notifcatios-sna").toggleClass("active-notifcatios")
    $(".overlaytwo-sna").toggleClass("active-overlay")
  })
  // ********************************************************
  $(".mobil-view-notifc").click((function () {
    $(".overlaytwo-notifcatios-sna").toggleClass("active-notifcatios")
  }))
  $(".close-notifcatios-overlay").click(function () {
    $(".overlaytwo-notifcatios-sna").removeClass("active-notifcatios")
    $(".overlaytwo-notifcatios-carts-sna").removeClass("active-notifcatios")
  })

  $(".all-popup-notifcation-items").click((function () {
    $(".overlaytwo-notifcatios-carts-sna").toggleClass("active-notifcatios")
  }))
  // *************************************************
  $(".Checkout-btn").click(function () {
    $(".condations-nd").addClass("all-termis-show")
    $(".sna-Checkout-data").addClass("open")
  })
  $(".condations-nd").click(function () {
    $('.andcondations-nd').html("<span class='loading_div' style='color:#fff;'><img src='/nazil/imgs/gear_loading_dark.svg' alt='loading..'></span>")
    $(this).removeClass("all-termis-show")
    $(".sna-Checkout-data").removeClass("open")
  })
  $(".close-option-btn").click(function () {
    $(".condations-nd").removeClass("all-termis-show")
    $(".sna-Checkout-data").removeClass("open")
  })
  // **************************************************
  // ************************************************
  $(".btn-filter").click(function () {
    $(".btn-filter").addClass("active-filter")
    $(this).siblings().removeClass("active-filter")
  })
  $(".horizental").click(function () {
    $(this).addClass("active-icon");
    $(".vertical").removeClass("active-icon");
    $(".allcourses-horizental").addClass("open-box");
    $(".allcourses-vertical").removeClass("open-box")
  })
  $(".vertical").click(function () {
    $(this).addClass("active-icon");
    $(".horizental").removeClass("active-icon");
    $(".allcourses-vertical").addClass("open-box");
    $(".allcourses-horizental").removeClass("open-box")
  })

  $('.theflexslider.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 1,
    dots: true,
    autoplay: true,
    navText: ["<img src='../../nazil/imgs/new-page/Group 13515.png'>", "<img src='../nazil/imgs/new-page/dir-cardslider.png'>"],
    autoplayTimeout: 7050

  })

  $('.nd-stm-carousel').owlCarousel({
    loop: true,
    margin: 5,
    autoplay: true,
    responsiveClass: true,
    autoWidth: true,
    items: 1,

  })



  // $('.nd-lms-carousel-description-card.owl-carousel').owlCarousel({
  //   loop: true,
  //   margin: 5,
  //   autoplay: true,
  //   responsiveClass: true,
  //   autoWidth: true,
  //   nav: false,
  //   items: 2,
  //   dots: false,
  //   responsive: {
  //     0: {
  //       items: 1,
  //       nav: true
  //     },
  //     600: {
  //       items: 2,
  //       nav: false
  //     },
  //     1000: {
  //       items: 2,
  //       nav: true,
  //       loop: false
  //     }
  //   }

  // })


  $(window).resize(function () {
    if ($(window).width() < 600) {
      $('.latestcourse-card-viewcard ').owlCarousel({
        loop: false,
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
    $('.latestcourse-card-viewcard ').owlCarousel({
      loop: true,
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
  $('.stm-Lms-allteacher.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    autoWidth: true,
    direction:'right',
    items: 2,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      }
    }

  })
  $('.single-item.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    // autoWidth: true,
    items: 2,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      }
    }

  })

  $('.homepage_mobile_carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    autoplayTimeout: 8000,
    // autoWidth: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      }
    }

  })

  // $('.single-item').slick();
  $('.lms-cours_support_img .owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    // autoWidth: true,
    items: 2,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      }
    }
  })

  $('.all-partner-items .owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    autoplay: false,
    responsiveClass: true,
    autoWidth: true,
    items: 2,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 2,
      }
    }
  })

  $('.stm-Lms-teachers-support').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    // autoWidth: true,
    items: 3,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      }
    }

  })

  $('.new-owl-blog.owl-carousel').owlCarousel({
    // loop: true,
    margin: 10,
    nav: false,
    items: 1,
    dots: true,
    autoWidth: true,
    autoplay: false,
    // autoplayTimeout:2050

  })

  var telInput = $("#phone"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");

  // initialise plugin
  telInput.intlTelInput({
    allowExtensions: true,
    formatOnDisplay: true,
    autoFormat: true,
    autoHideDialCode: true,
    autoPlaceholder: true,
    defaultCountry: "auto",
    ipinfoToken: "yolo",

    nationalMode: false,
    numberType: "MOBILE",
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
    utilsScript:
      "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
  });

  var reset = function () {
    telInput.removeClass("error");
    errorMsg.addClass("hide");
    validMsg.addClass("hide");
  };

  // on blur: validate
  telInput.blur(function () {
    reset();
    if ($.trim(telInput.val())) {
      if (telInput.intlTelInput("isValidNumber")) {
        validMsg.removeClass("hide");
      } else {
        telInput.addClass("error");
        errorMsg.removeClass("hide");
      }
    }
  });

  // on keyup / change flag: reset
  telInput.on("keyup change", reset);

  $('.ltr .right_side_info .owl-carousel').owlCarousel({
    autoWidth: true,
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

  $('.rtl .owl-carousel').owlCarousel({
    autoWidth: true,
    rtl: true,
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

});
window.onload = (event) => {
  $(".close-icon-").click(function () {
    $(".open-search-box").removeClass("open-box");
  })
  $(".close-menu span").click(function () {
    $(".new-small-menu").removeClass("down");
  })
  $(".open-termis").click(function () {
    $(".condations-nd").addClass("all-termis-show")
    $(this).parent().parent().siblings().find(".condations-nd").removeClass("all-termis-show")
  })
  $(".condations-nd").click(function () {
    $(this).removeClass("all-termis-show")
  })
  $(".testimony-wishlist-toggle").click(function () {
    $(this).toggleClass("toggle-wishlist")
  })
  $(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
  // $('.counter.new-offer-lms').counterUp({
  //   delay: 10,
  //   time: 2000
  // });

};

// ********************************************************************************
$(document).ready(function () {

  // ------------  File upload BEGIN ------------
  $('.file__input--file').on('change', function (event) {
    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      $("<div class='file__value'><div class='file__value--text'>" + file.name + "</div><div class='file__value--remove' data-id='" + file.name + "' ></div></div>").insertAfter('#file__input');
    }
  });
  // ***************************
  $('.select_personal_photo').on('change', function (event) {
    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      $("<div class='file__value_personal_photo'><div class='file__value--img'>" + file.name + "</div><div class='file__value--remove' data-id='" + file.name + "' ></div></div>").insertAfter('#onfile__input1');
    }
  });
  // *****************************

  //Click to remove item
  $('body').on('click', '.file__value', function () {
    $(this).remove();
  });
  // ------------ File upload END ------------
  $(document).ready(function() {
    //change selectboxes to selectize mode to be searchable
    $("select").select2();
  });

});
window.onload = (event) => {
    $(".close-icon-").click(function () {
        $(".open-search-box").removeClass("open-box");
      })
      $(".close-menu span").click(function () {
        $(".new-small-menu").removeClass("down");
      })
      $(".open-termis").click(function () {
        $(".condations-nd").addClass("all-termis-show")
        $(this).parent().parent().siblings().find(".condations-nd").removeClass("all-termis-show")
      })
      $(".condations-nd").click(function () {
        $(this).removeClass("all-termis-show")
      })
      $(".testimony-wishlist-toggle").click(function () {
        $(this).toggleClass("toggle-wishlist")
      })
      $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
};

