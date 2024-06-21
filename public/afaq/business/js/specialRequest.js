// ******** country code ***********
// -----Country Code Selection
$("#mobile_code").intlTelInput({
    initialCountry: "sa",
    separateDialCode: true,
    // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});
$(".termos-popup").click(function() {
    $('.termis-popup-window').addClass("active")
})

$(".condation-popup").click(function() {
    $(".condations-popup-window").addClass("active")
})
$(".close-window").click(function() {
    $(".condations-popup-window").removeClass("active")
    $('.termis-popup-window').removeClass("active")
})
