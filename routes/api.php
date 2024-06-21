<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Front', 'middleware' => ['locale']], function () {

    /************************************ homepage routes ************************************* */
    Route::get('homepage/welcomeMsg', fn () =>  response()->json(['status' => true, 'msg' => 'success', 'data' => ['msg' => WelcomeMsg()]]));
    Route::get('homepage/banners', 'HomePageApiController@banners');
    Route::get('homepage/featured', 'HomePageApiController@featured');
    Route::get('homepage/quickAccess', 'HomePageApiController@quickAccess');
    Route::get('homepage/topActivities', 'HomePageApiController@topActivities');
    Route::get('homepage/recorded', 'HomePageApiController@recordedCourses');
    Route::get('homepage/recentlyViewed', 'HomePageApiController@recentlyViewed');
    Route::get('homepage/statistics', 'HomePageApiController@statistics');
    Route::get('homepage/testimonials', 'HomePageApiController@testimonials');

    /***************************  CMS Page */
    Route::get('pages-content/{type}','CmsController@get_web_views_pages');
    Route::get('faqs-content','CmsController@faqs');
    Route::post('contact-us/send','CmsController@contact_us');
    Route::get('contact-us/info','CmsController@contact_info');

    /*************************** End CMS Page */
    /************************************ search routes ************************************* */
    Route::get('search', 'SearchApiController@search');

    /************************************ course routes ************************************* */
    Route::get('course/{course_id}', 'CourseApiController@content');
    Route::get('related-courses/{course_id}', 'CourseApiController@related_courses');
    /************************************ wishlist routes ************************************* */
    Route::post('wishlist/add', 'WishlistApiController@add');
    Route::post('wishlist/all', 'WishlistApiController@all');
    Route::post('wishlist/remove', 'WishlistApiController@remove');


    /*****************************************  Start Auth Routes   **************************************************/
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('registerLists', 'AuthController@registerLists');
    Route::post('completeUserData', 'UsersController@completeUserData');
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset-password', 'AuthController@reset');
    Route::post('/socialLogin', 'AuthController@social');
    Route::get('delete_account/{id}', 'UsersController@delete_account')->name('delete_account');

    /************************************************  End Auth Routes  ***********************************************************/

    /************************************ notifications auth routes ************************************* */
    Route::post('store-fcm-token', 'NotificationApiController@storeFcmToken')->name('store.token');
    Route::get('welcome-notification', "NotificationApiController@welcomeNotification");
    Route::get('notifications', "NotificationApiController@notifications");
    Route::get('notification/{id}', "NotificationApiController@notification");


    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', "AuthController@logout");
        Route::post('change-password', "AuthController@changePassword");
        Route::post('update-profile', "UsersController@updateProfile");
        Route::get('user', "UsersController@userData");
        Route::post('update-user-image', "UsersController@updateUserImage");

        /************************************ CartApiController auth routes ************************************* */
        Route::get('cart', "CartApiController@MyCart");
        Route::post('cart-add/{course_id}', "CartApiController@Add");
        Route::post('cart-remove/{course_id}', "CartApiController@Remove");

        Route::post('coupon-add', "CartApiController@CouponAdd");
        Route::post('coupon-remove', "CartApiController@CouponRemove");

        /************************************ PaymentApiController auth routes ************************************* */
        Route::get('bankinfo', "PaymentApiController@get_bank");
        Route::get('banks_list', "PaymentApiController@get_banks_list");
        Route::get('checkout', "PaymentApiController@checkout");
        Route::post('checkout_complete', "PaymentApiController@checkout_complete");
        Route::post('bank_confirm', "PaymentApiController@bank_confirm");
        Route::get('delete-payment/{id}', "PaymentApiController@delete_payment");
        Route::get('refund-course/{course_id}', "PaymentApiController@refund_course");
        Route::post('refund-course-action', "PaymentApiController@refund_course_action");

        /************************************ ProfileApiController auth routes ************************************* */
        Route::get('myinvoices', "ProfileApiController@myinvoices");
        Route::get('myCourses', "ProfileApiController@myCourses");
        Route::get('myCertificates', "ProfileApiController@myCertificates");
        Route::middleware(['course.access.content'])->group(function () {
            Route::get('one-course/{course_id}', 'CourseApiController@courseContent');
            Route::get('course-content/{course_id}', 'CourseApiController@course_content');
            Route::get('course-content-lecture/{course_id}/{lecture_id}','CourseApiController@course_content_lecture');
            Route::get('course-content-lecture-quize/{course_id}/{lecture_id}','CourseApiController@get_course_quize');
            Route::get('course-content-lecture-questionaire/{course_id}','CourseApiController@get_course_questionaire');
            Route::post('course-content-lecture-video','CourseApiController@videoResult');
        });
        Route::post('course-content-lecture-questionaire-answar','CourseApiController@questionaire_result');
        Route::post('quiz-answer/{quiz_id}','CourseApiController@quizAnswar');
        /************************************ WalletApiController auth routes ************************************* */
        Route::get('myWallet', "WalletApiController@MyWallet");
        Route::get('use-wallet', "WalletApiController@UseWallet");

        /************************************ PointApiController auth routes ************************************* */
        Route::get('myPoints', "PointApiController@MyPoints");
        Route::get('redeem-point', "PointApiController@RedeemPoint");

        Route::post('invite-point', "PointApiController@InvitePoint");
        /************************************ TicketApiController auth routes ************************************* */
        Route::get('ticketCategories', "TicketApiController@TicketCategories");
        Route::get('myTicket', "TicketApiController@MyTicket");
        Route::post('addTicket', "TicketApiController@StoreTicket");
        Route::get('userTicket/{id}', 'TicketApiController@one_ticket');
        Route::post('addComment', 'TicketApiController@StoreComment');
        Route::get('userComment/{ticket_id}', 'TicketApiController@one_comment');
        Route::get('closeTicket/{ticket_id}', 'TicketApiController@close_ticket');


    });
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    // Blogscomments
    //     Route::post('blogscomments/media', 'BlogscommentsApiController@storeMedia')->name('blogscomments.storeMedia');
    //     Route::apiResource('blogscomments', 'BlogscommentsApiController');
    Route::get('/page-content/{title}', 'PageContentApiController@show')->name('page-content');
});
// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
//     // Permissions
//     Route::apiResource('permissions', 'PermissionsApiController');

//     // Roles
//     Route::apiResource('roles', 'RolesApiController');

//     // Users
//     Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
//     Route::apiResource('users', 'UsersApiController');

//     // Faq Categories
//     Route::apiResource('faq-categories', 'FaqCategoryApiController');

//     // Faq Questions
//     Route::apiResource('faq-questions', 'FaqQuestionApiController');

//     // Payments
//     Route::apiResource('payments', 'PaymentApiController', ['except' => ['store', 'update', 'destroy']]);
//     // Home Page Slider
//     Route::post('home-page-sliders/media', 'HomePageSliderApiController@storeMedia')->name('home-page-sliders.storeMedia');
//     Route::apiResource('home-page-sliders', 'HomePageSliderApiController');

//     // Snippet
//     Route::post('snippets/media', 'SnippetApiController@storeMedia')->name('snippets.storeMedia');
//     Route::apiResource('snippets', 'SnippetApiController');

//     // Founders
//     Route::post('founders/media', 'FoundersApiController@storeMedia')->name('founders.storeMedia');
//     Route::apiResource('founders', 'FoundersApiController');

//     // Coming Soon
//     Route::post('coming-soons/media', 'ComingSoonApiController@storeMedia')->name('coming-soons.storeMedia');
//     Route::apiResource('coming-soons', 'ComingSoonApiController');

//     // Enquiries
//     Route::apiResource('enquiries', 'EnquiriesApiController', ['except' => ['store', 'update']]);
//     // Blogs
//     Route::post('blogs/media', 'BlogsApiController@storeMedia')->name('blogs.storeMedia');
//     Route::apiResource('blogs', 'BlogsApiController');

//     // Jobs
//     Route::post('jobs/media', 'JobsApiController@storeMedia')->name('jobs.storeMedia');
//     Route::apiResource('jobs', 'JobsApiController');

//     // Job Applications
//     Route::post('job-applications/media', 'JobApplicationsApiController@storeMedia')->name('job-applications.storeMedia');
//     Route::apiResource('job-applications', 'JobApplicationsApiController');
//     // Editor
//     Route::post('editors/media', 'EditorApiController@storeMedia')->name('editors.storeMedia');
//     Route::apiResource('editors', 'EditorApiController');

//     // Student Moodle
//     Route::post('student-moodles/media', 'StudentMoodleApiController@storeMedia')->name('student-moodles.storeMedia');
//     Route::apiResource('student-moodles', 'StudentMoodleApiController');
//     // Coupon Code
//     Route::apiResource('coupon-codes', 'CouponCodeApiController');
// });
