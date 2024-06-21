$('.tab_content > div:first-of-type').siblings().hide()
$('.tab_content > div:first-of-type').show()
$('.tab_links h5:first-of-type').addClass('active')

function show_answer(el){
    $(el).children('i').toggleClass('upside_arrow')
    $(el).next().toggleClass('show_answer')
}

function openTab(tabNum, tab){
    console.log(tabNum)
    console.log(tab)
    var tabId = 'tab' + tabNum
    $('#'+tabId).siblings().hide()
    $('#'+tabId).show()
    $(tab).siblings().removeClass('active')
    $(tab).addClass('active')
}

$(".faqs-slider-btn").click(function(){
    $(this).addClass("active")
    $(this).parent().siblings().find(".faqs-slider-btn").removeClass("active")
})
