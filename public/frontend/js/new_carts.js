function selectPaymentMethod(el){
    $(el).addClass('selected')
    $(el).siblings('.selected').removeClass('selected')
}

function submitPayment(){
    $('#submit_payment_popup').addClass('show')
    console.error('why are you in the console?? get out now!!')
}

function closeSumbitPaymentPopup(){
    $('#submit_payment_popup').removeClass('show')
}