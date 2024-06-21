<link rel="stylesheet" href="/frontend/css/course_content.css">
<link rel="stylesheet" href="/frontend/css/course_page.css">
<style>
    hr{
        border-top: 1px solid #91338d !important;
        background-color: #91338d;
    }

    a.active {
        height: auto;
        border-radius: 0px;
        border: none !important;
        /* background: transparent linear-gradient(259deg, #8E2A8A 0%, #6446A1 100%) 0% 0% no-repeat padding-box; */
        background: #fff !important;
        color: #495057 !important;
    }

    .accordion-body {
        padding: 0px;
        border: none;
        max-height: 500px;
        overflow-y: scroll;
    }

    .content-icon {
        width: 20px;
        margin: 0 10px;
    }

    .tab-pane {
        background: #FFFFFF;
        padding: 0.7rem;
        border-radius: 0.2rem;
        box-shadow: 0.5px 0.5px 0.5px 0.5px grey;
    }

    .accordion-button:not(.collapsed),
    .accordion-button:hover {
        background-color: #fff;
    }

    div#my-video {
        height: 400px;
    }

    .tab-pane {
        box-shadow: unset !important;
    }
    /* webkit start */
    ::-webkit-scrollbar{
        width: 5px;
        background-color: #ddd;
    }
    ::-webkit-scrollbar-thumb{
        background-color: #8E2A8A;
    }
    /* webkit end */
    /* side menu start */
    .lecture_title_side_menu {
        font-weight: bold;
        text-transform: capitalize;
    }

    .course_content_right_sections a.disabled .lecture_list_item_condition .video_thumbnail_container img.video_thumbnail {
        background-color: #d0d0d0;
    }

    .course_content_right_sections a.disabled {
        opacity: 0.3;
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail::before {
        content: '';
        position: absolute;
        border: solid 3px #8E2A8A;
        width: 60px;
        height: 60px;
        top: -5px;
        left: -5px;
        border-radius: 10px;
    }

    .rtl .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container::before {
        left: unset;
        right: -5px;
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail::after {
        content: '';
        position: absolute;
        background-color: #8E2A8A;
        clip-path: polygon(100% 0, 100% 100%, 0% 50%);
        width: 6px;
        height: 10px;
        top: 21px;
        left: -13px;
    }

    .rtl .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container::after {
        right: 23px;
        transform: rotate(180deg);
    }

    .course_content_right_sections .lecture_list_item_condition.not-completed .video_thumbnail_container .complete-percentage-hover {
        position: absolute;
        background-color: rgb(0 0 0 / 65%);
        width: 100%;
        height: 100%;
        border-radius: 5px;
        color: #fff;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container .complete-percentage-hover
    {
        position: absolute;
        background-color: rgb(0 0 0 / 65%);
        width: 100%;
        height: 100%;
        border-radius: 5px;
        color: #fff;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rtl .course_content_right_sections .lecture_list_item_condition.not-completed .video_thumbnail_container .complete-percentage-hover {
        left: unset;
    }

    .rtl .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container .complete-percentage-hover
    {
        left: unset;

    }
    .course_content_right_sections .video_thumbnail_container {
        position: relative;
        display: flex;
        flex-direction: row;
    }

    .course_content_right_sections .video_thumbnail {
        width: 50px;
        height: 50px;
        border-radius: 5px;
        object-fit: cover;
        margin: 0 30px 0 15px;
        box-shadow: 1px 1px 3px #c0c0c0;
        background-color: #fff;
        position: relative;
    }

    .rtl .course_content_right_sections .video_thumbnail {
        margin: 0 40px 0 30px;
    }

    .course_content_right_sections .lecture_list_item_condition {
        position: relative;
    }


    .course_content_right_sections {
        flex-direction: row-reverse;
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .course_content_right_sections .course_content_study_section,
    .course_content_right_sections .course_content_lecture_items_section{
        background-color: #fff;
        box-shadow: 1px 1px 10px #ddd;
        border-radius: 10px;
        width: 40%;
    }

    .course_content_right_sections .course_content_study_section{
        width: 30%;
        margin: 0 10px;
        overflow: hidden;
    }

    .course_content_right_sections .course_content_lecture_items_section{
        flex-grow: 1;
        padding: 10px;
    }

    .course_content_right_sections .course_content_lecture_items_section .tab-pane.fade{
        flex-grow: 1;
        padding: 10px;
    }

    .course_content_right_sections .course_content_lecture_items_section .image_container_in_course_content_area{
        height: clamp(200px, 50vw, 500px);
    }

    .course_content_right_sections .course_content_lecture_items_section .download_link_area_in_course_content .download_inner_continaer{
        height: clamp(200px, 50vw, 300px);
    }

    .course_content_right_sections .course_content_lecture_items_section .zoom_unavailable_in_course_content{
        /* height: clamp(200px, 50vw, 452px); */
        width: 100%;
        display: flex;
        text-align: center;
    }

    /* .course_content_right_sections .course_content_lecture_items_section .video_first_container{
        height: clamp(200px, 50vw, 452px);
    } */

    .course_content_right_sections .course_content_lecture_items_section .main-div.quiz-container{
        height: 500px;
        overflow-y: scroll;
    }

    .course_content_right_sections .course_content_lecture_items_section .submit-content-container .submit-content{
        width: fit-content;
    }

    .course_content_right_sections .course_content_lecture_items_section .quiz > li > p{
        font-weight: bold;
        margin-top: 25px;
    }

    .course_content_left_sections .left_tiny_header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .course_content_left_sections .left_tiny_header span {
        color: #8E2A8A;
    }

    .course_content_left_sections .left_tiny_header span:last-of-type {
        text-align: end;
    }

    .course_content_left_sections .left_tiny_header h4 {
        position: relative;
    }

    .course_content_left_sections .left_tiny_header h4::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0px;
        width: 75%;
        height: 10px;
        background-color: #00b1da;
        border-radius: 10px;
    }

    .rtl .course_content_left_sections .left_tiny_header h4::before {
        left: unset;
        right: 0px;
    }

    .course_content_right_sections a:not(.active) .lecture_list_item_condition::before {
        content: '';
        position: absolute;
        top: 17px;
        left: -10px;
        width: 15px;
        height: 15px;
        border-radius: 50px;
        /* background-image: url('/nazil/imgs/check.png'); completed course
                                                background-image: url('/nazil/imgs/cancel.png'); not finished course
                                                background-color: #ddd; not opened course */
        background-size: contain;
    }

    .rtl .course_content_right_sections a:not(.active) .lecture_list_item_condition::before {
        left: unset;
        right: -10px;
    }

    .course_content_right_sections .lecture_list_item_condition.completed::before {
        background-image: url('/nazil/imgs/check.png');
        /* completed course */
    }

    .course_content_right_sections .lecture_list_item_condition.not-completed::before {
        background-image: url('/nazil/imgs/cancel.png');
        /* not finished course */
    }

    .course_content_right_sections .lecture_list_item_condition.not-opened::before {
        background-color: #ddd;
        /* not opened course */
    }

    .course_content_right_sections .lecture_list_item_condition .video_thumbnail_container>p {
        font-size: 14px;
        height: 100%;
        overflow: hidden;
        margin: 0;
        width: calc(100% - 146px);
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container>p {
        font-weight: 900;
        color: #000;
        height: 3em;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container>p {
        color: #777;
    }

    .course_content_right_sections .lecture_list_item_condition.not-opened .video_thumbnail_container>p,
    .course_content_right_sections .lecture_list_item_condition.not-completed .video_thumbnail_container>p {
        font-weight: bold;
    }

    /* side menu end */
    /* questionaire modal start */
    .progress_line_parent{
        display: flex;
        flex-direction: row-reverse;
    }
    .questionaire_button{
        width: 25%;
        text-align: center;
        padding-top: 25px;
    }
    #exampleModal.show{
        height: 100%;
        display: flex !important;
        justify-content: center;
        flex-direction: column;
        overflow-y: hidden;
    }
    #exampleModal .modal-dialog{
        margin: 0 auto;
    }
    #exampleModal .modal-header .close{
        margin: 0;
        padding: 0;
    }
    #exampleModal .modal-header:before, #exampleModal .modal-header,
    #exampleModal .modal-header:before, #exampleModal .modal-footer{
        border: none;
    }
    #exampleModal .modal-header:before, #exampleModal .modal-header:after{
        content: unset;
    }
    #exampleModal .modal-header:before, #exampleModal .modal-footer button{
        background-image: linear-gradient(45deg, #081839, #845097);
        color: #fff;
        font-weight: 500;
        border: unset;
        border-radius: 50px;
    }
    #exampleModal .modal-header:before, #exampleModal .modal-body textarea{
        padding: 5px;
        border-radius: 5px;
        border-color: #845097;
        margin: 0 10px;
    }
    /* questionaire modal end */
    /* content start */
    .course_title{
        margin-bottom: 30px;
        font-weight: bold;
    }
    .questionaire_button button,
    .questionaire_button button:hover{
        background-color: #00B1DA;
        border: none;
        color: #fff;
        padding: 5px 25px;
        border-radius: 50px;
        letter-spacing: 0.5px;
    }
    .lecture_progress_bar {
        margin-bottom: 65px;
        width: 75%;
    }

    .vjs-matrix.video-js,
    .vjs-poster,
    .vjs-control-bar,
    .video-js .vjs-modal-dialog {
        border-radius: 10px !important;
    }

    .vjs-matrix.video-js {
        margin-top: -45px !important;
    }

    .sna_blue_color {
        color: #00B1DA;
    }

    .lecture_progress_bar .lecture_progress_ratio {
        font-size: 20px;
        margin: 0 10px;
    }

    .lecture_progress_bar .progress_white_line {
        width: 100%;
        height: 10px;
        background-color: #fff;
        border-radius: 3px;
        position: relative;
        margin-top: 15px;
        box-shadow: 0 0 10px #e7e7e7;
    }

    .lecture_progress_bar .progress_white_line .blue-line {
        position: absolute;
        /* width: 20%; */
        height: 10px;
        background-color: #00B1DA;
        border-radius: 3px;
    }

    .course_content_right_sections a.download_file_in_course_content{
        text-align: center;
    }

    .course_content_right_sections a.download_file_in_course_content div.download_icon{
        color: #00B1DA;
        border: none;
        padding: 5px 25px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        font-size: 50px;
        text-align: center;
        margin-bottom: 10px;
    }

    .course_content_right_sections a.download_file_in_course_content div.download_text{
        background-color: #00B1DA;
        border: none;
        color: #fff;
        padding: 5px 25px;
        border-radius: 50px;
        letter-spacing: 0.5px;
    }

    .course_content_right_sections .lectures_navigation_buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .course_content_right_sections .lectures_navigation_buttons .previous {
        padding: 5px;
        background-color: #fff;
        border: solid 2px #00B1DA;
        border-radius: 5px;
        font-weight: bold;
        font-size: 15px;
        width: 120px;
    }

    .course_content_right_sections .lectures_navigation_buttons .next {
        padding: 5px;
        background-color: #00B1DA;
        border-radius: 5px;
        font-weight: bold;
        font-size: 15px;
        color: #fff;
        width: 120px;
    }

    .course_content_right_sections .lecture_main_title {
        margin: 10px;
        font-weight: bold;
        font-size: 26px;
        text-transform: capitalize;
    }

    .course_content_right_sections .lecture_main_short_description {
        margin: 10px;
        color: #999999;
    }
    /* content end */
    /* notes section start */
    .render-notes{
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .notes_section {
        padding: 0;
        border-bottom: solid 1px #ddd;
        margin: 5px 0 15px;
    }

    .notes_section .notes_section_image {
        position: relative;
    }

    .notes_section .notes_section_image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 150px;
        height: 80px;
        border-radius: 10px;
        background-color: #4c4c4c40;
    }

    .rtl .notes_section .notes_section_image::after {
        left: unset;
        right: 0;
    }

    .notes_section .notes_section_image img {
        height: 80px;
        width: 150px;
        object-fit: cover;
        border-radius: 10px;
    }

    .notes_section p {
        font-size: 14px;
        overflow: hidden;
        margin: 15px 0;
        max-height: 100px;
    }

    .notes_section .notes_actions {
        display: flex;
        flex-direction: row;
        justify-content: start;
    }

    .notes_section .notes_actions span {
        color: #999999;
        font-size: 14px;
        cursor: pointer;
    }
    .notes_section{
        cursor: pointer;
    }
    /* notes section end */
    @media only screen and (max-width: 1200px){
        .course_content_right_sections{
            flex-wrap: wrap;
        }
        .course_content_right_sections .course_content_study_section{
            display: none;
        }
        .course_content_right_sections_on_small_screen{
            display: block;
        }
        .course_content_right_sections_on_small_screen a{
            color: #000;
            margin-bottom: 30px !important;
        }
        .course_content_right_sections_on_small_screen .lecture_list_item_condition {
            width: fit-content;
        }
        .course_content_right_sections_on_small_screen .video_thumbnail_container {
            width: 250px;
            height: 75px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        .course_content_right_sections_on_small_screen .video_thumbnail_container .video_thumbnail {
            height: 75px;
            width: 75px;
            background-color: #fff;
            border-radius: 5px;
        }
        .course_content_right_sections_on_small_screen .video_thumbnail_container p{
            padding: 0 10px;
            margin: 0;
            width: 60%;
            height: 1.9em;
            word-break: break-all;
            overflow: hidden;
            display: flex;
            /* align-items: center; */
            text-overflow: ellipsis;
        }
        .course_content_right_sections_on_small_screen a,
        .course_content_right_sections_on_small_screen a,
        .course_content_right_sections_on_small_screen button,
        .course_content_right_sections_on_small_screen button{
            background-color: unset !important;
        }
        .course_title{
            font-size: 20px;
        }
        .on_large_screen{
            display: none !important;
        }
        .small_screen_course_content_header{
            display: block;
        }
        .small_screen_course_content_header .progress_bar_top_info{
            display: flex;
            flex-direction: row;
        }
        .small_screen_course_content_header .progress_bar_top_info .questionaire_button{
            padding-top: 0;
            flex-grow: 1;
            text-align: end;
        }
        .small_screen_course_content_header .progress_line_parent{
            display: flex;
            flex-direction: column;
        }
        .small_screen_course_content_header .progress_line_parent .lecture_progress_bar{
            margin-bottom: 20px;
            width: 100%;
        }
        .course_content_right_sections_on_small_screen a.active .lecture_list_item_condition .video_thumbnail_container>p {
            font-weight: 900;
            color: #000;
        }

        .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container>p {
            color: #777;
        }

        .course_content_right_sections_on_small_screen .lecture_list_item_condition.not-opened .video_thumbnail_container>p,
        .course_content_right_sections_on_small_screen .lecture_list_item_condition.not-completed .video_thumbnail_container>p {
            font-weight: bold;
        }
        .course_content_right_sections_on_small_screen a.active .lecture_list_item_condition .video_thumbnail_container::before {
            content: '';
            position: absolute;
            border: solid 3px #8E2A8A;
            width: 90px;
            height: 90px;
            top: 5px;
            right: 13px;
            border-radius: 10px;
        }
        .ltr .course_content_right_sections_on_small_screen a.active .lecture_list_item_condition .video_thumbnail_container::before {
            right: unset;
            left: 13px;
        }
        .submit-content-container .submit-content {
            font-size: 15px !important;
        }
        .course_content_left_sections{
            margin-top: 25px;
        }
        .course_content_right_sections_on_small_screen a.disabled{
            opacity: 0.3;
        }
        .course_content_right_sections_on_small_screen a.list-group-item.disabled, .list-group-item:disabled{
            color: #6c757d;
            background-color: #fff;
        }
        /* .course_content_right_sections_on_small_screen .owl-stage{ */
            /* float: none; */
            /* width: max-content !important; */
        /* } */
        /* .course_content_right_sections_on_small_screen .owl-item{ */
            /* float: none; */
            /* width: auto !important;
        } */

        .course_content_right_sections_on_small_screen .owl-nav{
            display: none;
        }

    }
    @media only screen and (min-width: 1200px){
        .course_content_right_sections_on_small_screen {
            display: none !important;
        }
        .small_screen_course_content_header{
            display: none;
        }
    }

    /* stars start */
    .rating__stars {
        display: flex;
        padding-bottom: .375em;
        position: relative
    }
    .rating__star {
        display: block;
        overflow: visible;
        pointer-events: none;
        width: 2em;
        height: 2em
    }
    .rating__star-fill,
    .rating__star-line,
    .rating__star-ring,
    .rating__star-stroke {
        animation-duration: 1s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards
    }
    .rating__star-fill,
    .rating__star-line,
    .rating__star-ring {
        stroke: var(--yellow)
    }
    .rating__star-fill {
        fill: var(--yellow);
        transform: scale(0);
        transition: fill var(--trans-dur) var(--bezier), transform var(--trans-dur) var(--bezier)
    }
    .rating__star-stroke {
        stroke: hsl(223deg, 10%, 80%);
        transition: stroke var(--trans-dur)
    }
    .rating__label {
        cursor: pointer;
        padding: .125em
    }
    .rating__label--delay1 .rating__star-fill,
    .rating__label--delay1 .rating__star-line,
    .rating__label--delay1 .rating__star-ring,
    .rating__label--delay1 .rating__star-stroke {
        animation-delay: 50ms
    }
    .rating__label--delay2 .rating__star-fill,
    .rating__label--delay2 .rating__star-line,
    .rating__label--delay2 .rating__star-ring,
    .rating__label--delay2 .rating__star-stroke {
        animation-delay: .1s
    }
    .rating__label--delay3 .rating__star-fill,
    .rating__label--delay3 .rating__star-line,
    .rating__label--delay3 .rating__star-ring,
    .rating__label--delay3 .rating__star-stroke {
        animation-delay: .15s
    }
    .rating__label--delay4 .rating__star-fill,
    .rating__label--delay4 .rating__star-line,
    .rating__label--delay4 .rating__star-ring,
    .rating__label--delay4 .rating__star-stroke {
        animation-delay: .2s
    }
    .rating__input {
        -webkit-appearance: none;
        appearance: none
    }
    .rating__input:hover~[data-rating]:not([hidden]) {
        display: none
    }
    .rating__input-1:hover~[data-rating="1"][hidden],
    .rating__input-2:hover~[data-rating="2"][hidden],
    .rating__input-3:hover~[data-rating="3"][hidden],
    .rating__input-4:hover~[data-rating="4"][hidden],
    .rating__input-5:hover~[data-rating="5"][hidden],
    .rating__input:checked:hover~[data-rating]:not([hidden]) {
        display: block
    }
    .rating__input-1:hover~.rating__label:first-of-type .rating__star-stroke,
    .rating__input-2:hover~.rating__label:nth-of-type(-n+2) .rating__star-stroke,
    .rating__input-3:hover~.rating__label:nth-of-type(-n+3) .rating__star-stroke,
    .rating__input-4:hover~.rating__label:nth-of-type(-n+4) .rating__star-stroke,
    .rating__input-5:hover~.rating__label:nth-of-type(-n+5) .rating__star-stroke {
        stroke: var(--yellow);
        transform: scale(1)
    }
    .rating__input-1:checked~.rating__label:first-of-type .rating__star-ring,
    .rating__input-2:checked~.rating__label:nth-of-type(-n+2) .rating__star-ring,
    .rating__input-3:checked~.rating__label:nth-of-type(-n+3) .rating__star-ring,
    .rating__input-4:checked~.rating__label:nth-of-type(-n+4) .rating__star-ring,
    .rating__input-5:checked~.rating__label:nth-of-type(-n+5) .rating__star-ring {
        animation-name: starRing
    }
    .rating__input-1:checked~.rating__label:first-of-type .rating__star-stroke,
    .rating__input-2:checked~.rating__label:nth-of-type(-n+2) .rating__star-stroke,
    .rating__input-3:checked~.rating__label:nth-of-type(-n+3) .rating__star-stroke,
    .rating__input-4:checked~.rating__label:nth-of-type(-n+4) .rating__star-stroke,
    .rating__input-5:checked~.rating__label:nth-of-type(-n+5) .rating__star-stroke {
        animation-name: starStroke
    }
    .rating__input-1:checked~.rating__label:first-of-type .rating__star-line,
    .rating__input-2:checked~.rating__label:nth-of-type(-n+2) .rating__star-line,
    .rating__input-3:checked~.rating__label:nth-of-type(-n+3) .rating__star-line,
    .rating__input-4:checked~.rating__label:nth-of-type(-n+4) .rating__star-line,
    .rating__input-5:checked~.rating__label:nth-of-type(-n+5) .rating__star-line {
        animation-name: starLine
    }
    .rating__input-1:checked~.rating__label:first-of-type .rating__star-fill,
    .rating__input-2:checked~.rating__label:nth-of-type(-n+2) .rating__star-fill,
    .rating__input-3:checked~.rating__label:nth-of-type(-n+3) .rating__star-fill,
    .rating__input-4:checked~.rating__label:nth-of-type(-n+4) .rating__star-fill,
    .rating__input-5:checked~.rating__label:nth-of-type(-n+5) .rating__star-fill {
        animation-name: starFill
    }
    .rating__input-1:not(:checked):hover~.rating__label:first-of-type .rating__star-fill,
    .rating__input-2:not(:checked):hover~.rating__label:nth-of-type(2) .rating__star-fill,
    .rating__input-3:not(:checked):hover~.rating__label:nth-of-type(3) .rating__star-fill,
    .rating__input-4:not(:checked):hover~.rating__label:nth-of-type(4) .rating__star-fill,
    .rating__input-5:not(:checked):hover~.rating__label:nth-of-type(5) .rating__star-fill {
        fill: var(--yellow-t)
    }
    .rating__sr {
        clip: rect(1px, 1px, 1px, 1px);
        overflow: hidden;
        position: absolute;
        width: 1px;
        height: 1px
    }
    @keyframes starRing {
        20%,
        from {
            animation-timing-function: ease-in;
            opacity: 1;
            stroke-width: 16px;
            transform: scale(0)
        }
        35% {
            animation-timing-function: ease-out;
            opacity: .5;
            stroke-width: 16px;
            transform: scale(1)
        }
        50%,
        to {
            opacity: 0;
            stroke-width: 0;
            transform: scale(1)
        }
    }
    @keyframes starFill {
        40%,
        from {
            animation-timing-function: ease-out;
            transform: scale(0)
        }
        60% {
            animation-timing-function: ease-in-out;
            transform: scale(1.2)
        }
        80% {
            transform: scale(.9)
        }
        to {
            transform: scale(1)
        }
    }
    @keyframes starStroke {
        from {
            transform: scale(1)
        }
        20%,
        to {
            transform: scale(0)
        }
    }
    @keyframes starLine {
        40%,
        from {
            animation-timing-function: ease-out;
            stroke-dasharray: 1 23;
            stroke-dashoffset: 1
        }
        60%,
        to {
            stroke-dasharray: 12 12;
            stroke-dashoffset: -12
        }
    }
        /* stars end */
</style>
