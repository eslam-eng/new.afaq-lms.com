function collapseTitleInvoice(el){
    $(el).toggleClass('rotate')
    $(el).siblings('.invoice_title_and_price').toggleClass('open')
    // console.log($('.invoice_grid_area .invoice_my_profile').closest('.invoice_my_profile').html)
    $(el).parents('.invoice_my_profile').toggleClass('move_down')
    // $('.invoice_grid_area .invoice_my_profile').toggleClass('move_down')
};