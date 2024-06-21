@extends('layouts.front')
@section('content')
<style>

</style>
<div class="all-courses" style="margin-bottom: 1000px;">
    <div class="container">
        <div class="courses_filters ">
            <div class="course-title">
                <h1>Courses</h1>
            </div>
            <div class="course-sort-by d-flex align-items-center">
                <span>SORT BY:</span>
                <em style="display: inline-block;width:10px"></em>
                <div class="course-option">

                    <select class="no-search select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="date_high">Release date (newest first)</option>
                        <option value="date_low">Release date (oldest first)</option>
                        <option value="price_high">Price high</option>
                        <option value="price_low">Price low</option>
                        <option value="rating">Overall Rating</option>
                        <option value="popular">Popular (most viewed)</option>
                    </select>
                </div>
                <em style="display: inline-block;width:20px"></em>
                <div class="course-view-type d-flex align-items-center">
                    <span class="horizental"><i class="fas fa-th-list"></i></span>
                    <em style="display: inline-block;width:15px"></em>
                    <span class="vertical active-icon"><i class="fas fa-list-ul"></i></span>

                </div>
            </div>
        </div>
        <div class="allcourses-vertical open-box">
            <div class="course-vertical">
                <div class="course-vertical-card d-flex justify-content-start">
                    <div class="vertical-card-img">
                        <a href="">
                            <div class="vertical-img">
                                <img src="https://wordpresslms.nazil.net/wp-content/uploads/2021/10/course_image_106-scaled-544x322.jpg" alt="">
                                <span>Course</span>
                            </div>
                            <button class="preview-cours">preview this course</button>
                        </a>
                    </div>
                    <div style="width: 30px;"></div>
                    <div class="vertical-card-description">
                        <div class="description-card-">
                            <span class="specialties">All specialties</span>
                            <a href="">
                                <h4>Risk factors for chronic diseases and ways to prevent them</h4>
                            </a>
                            <div class="stm_lms_courses-data d-flex ">
                                <div class="courses-online">
                                    <i class="fas fa-signal"></i>
                                    <span> offline</span>
                                </div>
                                <div style="width: 40px; display: inline-block;"></div>
                                <div class="courses-online">
                                    <i class="fas fa-bars"></i>
                                    <span>Lectures </span>
                                </div>
                                <div style="width: 40px; display: inline-block;"></div>
                                <div class="courses-online">
                                    <i class="far fa-clock"></i>
                                    <span>Hours </span>
                                </div>
                            </div>
                            <p>
                                There are many factors that cause the occurrence of chronic diseases or increase their severity and worsen the patient's health condition. In this ...
                            </p>
                            <div class="description-card-options d-flex justify-content-between">
                                <div class="offer-wishlist-type">
                                    <div class="offer-type">
                                        <strong>Free</strong>
                                    </div>
                                    <div class="stm-lms-wishlist">
                                        <i class="far fa-heart"></i>
                                        <span>Add to Wishlist</span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://wordpresslms.nazil.net/wp-content/uploads/avatars/2/617c4b01d2970-bpfull.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">
                                        AfAQ HEALTH EDUCATION </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="allcourses-horizental">
            <div class="all-courses-card">
                <div class="row justify-content-center">
                    <div class=" thecard-category col-md-6 col-lg-3 col-sm-6 mb-5 mix All-Categories All-specialties Languages">
                        <div class="data-in-all-category">
                            <div class="card-mst-img">
                                <div class="card-category-img">
                                    <img src="https://sna.test/storage/660/619a7d2ea072f_course_image_100-272x161.jpg" alt="">
                                    <span>English Language and Literature</span>


                                </div>
                                <div class="card-category-description">
                                    <h3>English Language and Literature</h3>

                                    <h5>
                                        <p><span style="font-size:.95rem;">This course will enable you to acquire the basic language skills&nbsp; .</span><br></p>
                                        <p><span style="font-size:.95rem;"><br></span></p>
                                        <p><span style="font-size:.95rem;"><br></span></p>
                                    </h5>
                                </div>
                                <div class="card-category-date d-flex justify-content-between">
                                    <div class="date-">
                                        <i class="fas fa-calendar-week"></i>
                                        <strong>22-11-2021</strong>

                                    </div>

                                    <div class="offer-type">

                                        <strong>Free</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="data-in-all-category-filtter on-right">
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">

                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_title">
                                    <a href="https://wordpresslms.nazil.net/courses/risk-factors-for-chronic-diseases-and-ways-to-prevent-them/">
                                        <h4>
                                            <p><span style="font-size:.95rem;">This course will enable you to acquire the basic language skills&nbsp; .</span><br></p>
                                            <p><span style="font-size:.95rem;"><br></span></p>
                                            <p><span style="font-size:.95rem;"><br></span></p>
                                        </h4>
                                    </a>
                                </div>
                                <div class="stm_lms_courses__single--info_excerpt">

                                </div>
                                <div class="stm_lms_courses-data d-flex ">
                                    <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> offline</span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="fas fa-bars"></i>
                                        <span>Lectures </span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="far fa-clock"></i>
                                        <span>Hours </span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_preview">
                                    <a href="" title="Risk factors for chronic diseases and ways to prevent them" class="heading_font">
                                        Preview this course </a>
                                </div>
                                <div class="free-wishlist d-flex justify-content-between">
                                    <div class="wishlist-icon">

                                        <i class="far fa-heart"></i>

                                    </div>
                                    <div class="offer-type">

                                        <strong>Free</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" thecard-category col-md-6 col-lg-3 col-sm-6 mb-5 mix All-Categories All-specialties Medicine">
                        <div class="data-in-all-category">
                            <div class="card-mst-img">
                                <div class="card-category-img">
                                    <img src="https://sna.test/storage/662/619a7d624bf07_course_image_105-scaled-272x161.jpg" alt="">
                                    <span>Gynecology</span>


                                </div>
                                <div class="card-category-description">
                                    <h3>Gynecology</h3>

                                    <h5>
                                        listening, speaking, reading and writing in order to communicate
                                    </h5>
                                </div>
                                <div class="card-category-date d-flex justify-content-between">
                                    <div class="date-">
                                        <i class="fas fa-calendar-week"></i>
                                        <strong>22-11-2021</strong>

                                    </div>

                                    <div class="offer-type">
                                        <strong>190 SR </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="data-in-all-category-filtter on-right">
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">

                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_title">
                                    <a href="https://wordpresslms.nazil.net/courses/risk-factors-for-chronic-diseases-and-ways-to-prevent-them/">
                                        <h4> listening, speaking, reading and writing in order to communicate</h4>
                                    </a>
                                </div>
                                <div class="stm_lms_courses__single--info_excerpt">

                                </div>
                                <div class="stm_lms_courses-data d-flex ">
                                    <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> offline</span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="fas fa-bars"></i>
                                        <span>Lectures </span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="far fa-clock"></i>
                                        <span>Hours </span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_preview">
                                    <a href="" title="Risk factors for chronic diseases and ways to prevent them" class="heading_font">
                                        Preview this course </a>
                                </div>
                                <div class="free-wishlist d-flex justify-content-between">
                                    <div class="wishlist-icon">

                                        <i class="far fa-heart"></i>

                                    </div>
                                    <div class="offer-type">
                                        <strong>190 SR </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" thecard-category col-md-6 col-lg-3 col-sm-6 mb-5 mix All-Categories All-specialties Medicine">
                        <div class="data-in-all-category">
                            <div class="card-mst-img">
                                <div class="card-category-img">
                                    <img src="https://sna.test/storage/664/619a7e06c7caf_course_image_104-scaled-272x161.jpg" alt="">
                                    <span>Nanomedicine</span>


                                </div>
                                <div class="card-category-description">
                                    <h3>Nanomedicine</h3>

                                    <h5>
                                        listening, speaking, reading and writing in order to communicate
                                    </h5>
                                </div>
                                <div class="card-category-date d-flex justify-content-between">
                                    <div class="date-">
                                        <i class="fas fa-calendar-week"></i>
                                        <strong>15-11-2021</strong>

                                    </div>

                                    <div class="offer-type">
                                        <strong>90 SR </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="data-in-all-category-filtter on-right">
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">

                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_title">
                                    <a href="https://wordpresslms.nazil.net/courses/risk-factors-for-chronic-diseases-and-ways-to-prevent-them/">
                                        <h4> listening, speaking, reading and writing in order to communicate</h4>
                                    </a>
                                </div>
                                <div class="stm_lms_courses__single--info_excerpt">

                                </div>
                                <div class="stm_lms_courses-data d-flex ">
                                    <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> offline</span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="fas fa-bars"></i>
                                        <span>Lectures </span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="far fa-clock"></i>
                                        <span>Hours </span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_preview">
                                    <a href="" title="Risk factors for chronic diseases and ways to prevent them" class="heading_font">
                                        Preview this course </a>
                                </div>
                                <div class="free-wishlist d-flex justify-content-between">
                                    <div class="wishlist-icon">

                                        <i class="far fa-heart"></i>

                                    </div>
                                    <div class="offer-type">
                                        <strong>90 SR </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" thecard-category col-md-6 col-lg-3 col-sm-6 mb-5 mix All-Categories All-specialties Faculty of Economics and Political Science">
                        <div class="data-in-all-category">
                            <div class="card-mst-img">
                                <div class="card-category-img">
                                    <img src="https://sna.test/storage/666/619a7f3a84c50_course_image_101-scaled-272x161.jpg" alt="">
                                    <span>Course5</span>


                                </div>
                                <div class="card-category-description">
                                    <h3>Students</h3>

                                    <h5>
                                        Basic Medical Terminology
                                    </h5>
                                </div>
                                <div class="card-category-date d-flex justify-content-between">
                                    <div class="date-">
                                        <i class="fas fa-calendar-week"></i>
                                        <strong>21-11-2021</strong>

                                    </div>

                                    <div class="offer-type">
                                        <strong>5000 SR </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="data-in-all-category-filtter on-right">
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">
                                        ["Arafa"]
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_title">
                                    <a href="https://wordpresslms.nazil.net/courses/risk-factors-for-chronic-diseases-and-ways-to-prevent-them/">
                                        <h4> Basic Medical Terminology</h4>
                                    </a>
                                </div>
                                <div class="stm_lms_courses__single--info_excerpt">
                                    This course will help students and professionals in gaining a clear and comprehensive foundation in medical terminology by understanding and memori...
                                </div>
                                <div class="stm_lms_courses-data d-flex ">
                                    <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> online</span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="fas fa-bars"></i>
                                        <span>15Lectures </span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="far fa-clock"></i>
                                        <span>19:18:00Hours </span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_preview">
                                    <a href="" title="Risk factors for chronic diseases and ways to prevent them" class="heading_font">
                                        Preview this course </a>
                                </div>
                                <div class="free-wishlist d-flex justify-content-between">
                                    <div class="wishlist-icon">

                                        <i class="far fa-heart"></i>

                                    </div>
                                    <div class="offer-type">
                                        <strong>5000 SR </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" thecard-category col-md-6 col-lg-3 col-sm-6 mb-5 mix All-Categories All-specialties Languages">
                        <div class="data-in-all-category">
                            <div class="card-mst-img">
                                <div class="card-category-img">
                                    <img src="https://sna.test/storage/668/619a7fa002d96_course_image-272x161.jpg" alt="">
                                    <span>English 101</span>


                                </div>
                                <div class="card-category-description">
                                    <h3>English 101</h3>

                                    <h5>
                                        listening, speaking, reading and writing in order to communicate
                                    </h5>
                                </div>
                                <div class="card-category-date d-flex justify-content-between">
                                    <div class="date-">
                                        <i class="fas fa-calendar-week"></i>
                                        <strong>23-11-2021</strong>

                                    </div>

                                    <div class="offer-type">
                                        <strong>420 SR </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="data-in-all-category-filtter on-right">
                                <div class="stm_lms_courses__single--info_author">
                                    <div class="stm_lms_courses__single--info_author__avatar">
                                        <img alt="" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" class="avatar avatar-215 photo" height="215" width="215" >
                                    </div>
                                    <div class="stm_lms_courses__single--info_author__login">

                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_title">
                                    <a href="https://wordpresslms.nazil.net/courses/risk-factors-for-chronic-diseases-and-ways-to-prevent-them/">
                                        <h4> listening, speaking, reading and writing in order to communicate</h4>
                                    </a>
                                </div>
                                <div class="stm_lms_courses__single--info_excerpt">

                                </div>
                                <div class="stm_lms_courses-data d-flex ">
                                    <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> offline</span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="fas fa-bars"></i>
                                        <span>Lectures </span>
                                    </div>
                                    <div style="width: 40px; display: inline-block;"></div>
                                    <div class="courses-online">
                                        <i class="far fa-clock"></i>
                                        <span>Hours </span>
                                    </div>
                                </div>
                                <div class="stm_lms_courses__single--info_preview">
                                    <a href="" title="Risk factors for chronic diseases and ways to prevent them" class="heading_font">
                                        Preview this course </a>
                                </div>
                                <div class="free-wishlist d-flex justify-content-between">
                                    <div class="wishlist-icon">

                                        <i class="far fa-heart"></i>

                                    </div>
                                    <div class="offer-type">
                                        <strong>420 SR </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="share-items d-flex justify-content-start flex-wrap">
            <div class="fac-share btn-share">
                <i class="fab fa-facebook"></i>
                <span>share</span>
            </div>
            <div style="width: 20px;"></div>
            <div class="twitter-share btn-share">
                <i class="fab fa-twitter"></i>
                <span>twitter</span>
            </div>
            <div style="width: 20px;"></div>
            <div class="pinterist-share btn-share">
                <i class="fab fa-pinterest"></i>
                <span>share</span>
            </div>
            <div style="width: 20px;"></div>
            <div class="linked-share btn-share">
                <i class="fab fa-linkedin-in"></i>
                <span>share</span>
            </div>
            <div style="width: 20px;"></div>
            <div class="digg-share btn-share">
                <i class="fab fa-digg"></i>
                <span>share</span>
            </div>
        </div> -->
    </div>
</div>
<!-- <script>
    window.onload = (event) => {

        $(".horizental").click(function() {
            $(this).addClass("active-icon");
            $(".vertical").removeClass("active-icon");
            $(".allcourses-horizental").addClass("open-box");
            $(".allcourses-vertical").removeClass("open-box")
        })
        $(".vertical").click(function() {
            $(this).addClass("active-icon");
            $(".horizental").removeClass("active-icon");
            $(".allcourses-vertical").addClass("open-box");
            $(".allcourses-horizental").removeClass("open-box")
        })
    };
</script> -->
<!-- <div class="card">
    <div class="card-header">
        {{ trans('cruds.allCourse.title') }}
    </div>

    <div class="card-body">
        <p>
           A7a now
        </p>
    </div>
</div> -->



@endsection
