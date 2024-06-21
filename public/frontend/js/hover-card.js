    function show_card_details(card){
        var body_rect = document.body.getBoundingClientRect(),
            body_width = document.body.clientWidth,
            card_position = card.getBoundingClientRect(),
            card_width = card.clientWidth,
            offset = card_position.left - body_rect.left,
            screen_center = body_width / 2,
            card_end_point = offset + card_width,
            card_right = false,
            prev = card.previousElementSibling;
;

        if(card_end_point > screen_center){
            card_right = true;

            card.children[0].children[3].classList.add('changed');

            card.children[0].children[3].style.transition = 'none';
            card.children[0].children[3].style.height = 'auto';
            card.children[0].children[3].style.right = '100%';
        }else{
            card_right = false;

            card.children[0].children[3].classList.remove('changed');

            card.children[0].children[3].style.transition = 'none';
            card.children[0].children[3].style.height = 'auto';
            card.children[0].children[3].style.left = '100%';
        }
        // card.children[0].children[3].style.transition = '0.2s';
        card.children[0].children[3].style.width = '315px';
        card.children[0].children[3].style.opacity = '1';
        card.children[0].children[3].style.zIndex = '10000';
        card.children[0].children[3].style.overflow = 'visible';

    }

    function hide_card_details(card){
        // card.children[0].children[3].style.transition = 'none';
        card.children[0].children[3].style.width = '0';
        card.children[0].children[3].style.height = '0';
        card.children[0].children[3].style.opacity = '0';
        // card.children[0].children[3].style.zIndex = '0';
        card.children[0].children[3].style.overflow = 'hidden';

    }
