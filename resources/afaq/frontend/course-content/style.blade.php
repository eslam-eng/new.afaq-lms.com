<link rel="stylesheet" href="/frontend/css/course_content.css">
<link rel="stylesheet" href="/frontend/css/course_page.css">
<style>
    body {
        background: #f7f7fa !important;
    }

    a.active {
        height: auto;
        border-radius: 0px;
        border: none !important;
        /* background: transparent linear-gradient(259deg, #88BD2F 0%, #6446A1 100%) 0% 0% no-repeat padding-box; */
        background: #fff !important;
        color: #495057 !important;
    }

    .accordion-body {
        padding: 0px;
        border: none;
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

    /* side menu start */
    /* .lecture_title_side_menu {
        font-weight: bold;
        text-transform: capitalize;
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container::before {
        content: '';
        position: absolute;
        border: solid 3px #88BD2F;
        width: 90px;
        height: 90px;
        top: 13px;
        left: 33px;
        border-radius: 10px;
    }

    .rtl .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container::before {
        left: unset;
        right: 33px;
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container::after {
        content: '';
        position: absolute;
        background-color: #88BD2F;
        clip-path: polygon(100% 0, 100% 100%, 0% 50%);
        width: 6px;
        height: 10px;
        top: 55px;
        left: 23px;
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

    .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container .complete-percentage-hover {
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

    .rtl .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container .complete-percentage-hover {
        left: unset;

    }

    .course_content_right_sections .video_thumbnail_container {
        position: relative;
        display: flex;
        flex-direction: row;
    }

    .course_content_right_sections .video_thumbnail {
        width: 76px;
        height: 76px;
        border-radius: 5px;
        object-fit: cover;
        margin: 20px 30px 20px 40px;
        box-shadow: 1px 1px 10px #c0c0c0;
        position: relative;
    }

    .rtl .course_content_right_sections .video_thumbnail {
        margin: 20px 40px 20px 30px;
    }

    .course_content_right_sections .lecture_list_item_condition {
        position: relative;
    }


    .course_content_right_sections {
        flex-direction: row-reverse;
    }


    .course_content_left_sections {
        background-color: #fff;
        box-shadow: 1px 1px 10px #ddd;
        border-radius: 10px;
        padding: 20px;
    }

    .course_content_left_sections .left_tiny_header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .course_content_left_sections .left_tiny_header span {
        color: #88BD2F;
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
        background-color: #88BD2F;
        border-radius: 10px;
    }

    .rtl .course_content_left_sections .left_tiny_header h4::before {
        left: unset;
        right: 0px;
    }

    .course_content_right_sections a:not(.active) .lecture_list_item_condition::before {
        content: '';
        position: absolute;
        top: 40px;
        left: -10px;
        width: 35px;
        height: 35px;
        border-radius: 50px;
        /* background-image: url('/nazil/imgs/check.png'); completed course
                                                background-image: url('/nazil/imgs/cancel.png'); not finished course
                                                background-color: #ddd; not opened course */
        /* background-size: contain; */
    /* } */

    /* .rtl .course_content_right_sections a:not(.active) .lecture_list_item_condition::before {
        left: unset;
        right: -10px;
    } */

    /* .course_content_right_sections .lecture_list_item_condition.completed::before {
        background-image: url('/nazil/imgs/check.png'); */
        /* completed course */
    /* } */

    /* .course_content_right_sections .lecture_list_item_condition.not-completed::before {
        background-image: url('/nazil/imgs/cancel.png'); */
        /* not finished course */
    /* } */

    /* .course_content_right_sections .lecture_list_item_condition.not-opened::before {
        background-color: #ddd; */
        /* not opened course */
    /* } */

    /* .course_content_right_sections .lecture_list_item_condition .video_thumbnail_container>p {
        font-size: 14px;
        height: 65px;
        overflow: hidden;
        margin: 26px 0 26px 0;
    }

    .course_content_right_sections a.active .lecture_list_item_condition .video_thumbnail_container>p {
        font-weight: 900;
        color: #000;
    }

    .course_content_right_sections .lecture_list_item_condition.completed .video_thumbnail_container>p {
        color: #777;
    }

    .course_content_right_sections .lecture_list_item_condition.not-opened .video_thumbnail_container>p,
    .course_content_right_sections .lecture_list_item_condition.not-completed .video_thumbnail_container>p {
        font-weight: bold;
    } */

    /* side menu end */
    /* content start */
    /* .lecture_progress_bar {
        margin-bottom: 65px;
    }

    .vjs-matrix.video-js,
    .vjs-poster,
    .vjs-control-bar {
        border-radius: 10px !important;
    }

    .vjs-matrix.video-js {
        margin-top: -45px !important;
    }

    .sna_blue_color {
        color: #88BD2F;
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
        width: 20%;
        height: 10px;
        background-color: #88BD2F;
        border-radius: 3px;
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
        font-size: 20px;
        width: 120px;
    }

    .course_content_right_sections .lectures_navigation_buttons .next {
        padding: 5px;
        background-color: #00B1DA;
        border-radius: 5px;
        font-weight: bold;
        font-size: 20px;
        color: #fff;
        width: 120px;
    }

    .course_content_right_sections .lecture_main_title {
        margin: 10px;
        font-weight: bold;
        font-size: 40px;
        text-transform: capitalize;
    }

    .course_content_right_sections .lecture_main_short_description {
        margin: 10px;
        color: #999999;
    } */

    /* content end */
    /* notes section start */
    .notes_section {
        padding: 20px 0;
        border-bottom: solid 1px #ddd;
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

    .notes_section {
        cursor: pointer;
    }

    .page-details-section {
        position: relative;
        width: calc(100% - 30%);
        padding: 10px;
    }

    .contact-page-details {
        display: flex;
        /* align-items: center; */
        justify-content: space-between;
    }

    .page-details-data-lms {
        background: #fff;
        box-shadow: 0px 8px 26px #d4d4d49e;
        border-radius: 6px;
        /* margin-top: 100px; */
        display: flex;
    }

    .cours-img-lms {
        width: 77px;
        height: 77px;
        position: relative;
        margin: 0 5px;
        overflow: hidden;
        max-width: 77px;
        min-width: 77px;
        border-radius: 6px;
    }

    .cours-number {
        display: flex;
        justify-content: space-between;
    }

    .lms-course-list {
        width: calc(100% - 500px);
        padding: 10px;
        height: auto;
        overflow: hidden;
        max-height: 1000px;
        overflow-y: auto;
    }

    .nots-side {
        width: calc(100% - 500px);
        padding: 10px;
        height: auto;
        overflow: hidden;
        max-height: 1000px;
        overflow-y: auto;
    }

    .lms-active-cours {
        width: 500px;
    }

    /*
 *  STYLE 2
 */

    .nots-side::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .nots-side::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .nots-side::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(253, 253, 253, 0.3);
        background-color: #FFF;
    }


    .btn-control button {
        background: unset;
        border: unset;
        padding: 2px 20px;
        border-radius: 6px;
        font-size: 16px;
    }

    button.Previous {
        border: 1px solid #88BD2F;
    }

    button.Next {
        background: #88BD2F;
        color: #fff;
    }


    /* notes section end */
</style>
