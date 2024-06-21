$(function () {
    $(".close-setion-lms").click(function () {
        $(this).parent(".get-app-afaqlogo_").parent(".getapp-data").parent(".get-app-section").parent('.the-get-app-btn').addClass("active")
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

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

});
