<?php

use App\DataLoader\Core\Loader;
use App\Http\Controllers\Actions\Migration\CertificatesMigration;
use App\Http\Controllers\Actions\Migration\CoursesMigration;
use App\Http\Controllers\Actions\Migration\MigrateUserSpeciality;
use App\Http\Controllers\Actions\Migration\PaymentsMigration;
use App\Http\Controllers\Actions\Migration\RolesMigration;
use App\Http\Controllers\Actions\Migration\UsersMigration;
use App\Jobs\GetPaymentsFormHyper;
use App\Models\Course;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\UserCertificate;
use App\Payments\Gateways\Tabby\Tabby;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Models\Enroll;
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('checkpayments',function(){
    GetPaymentsFormHyper::dispatch();
});
Route::get('get-diff',function(){
    $payments = Payment::where('approved', 1)->whereHas('payment_enrolls')->doesntHave('payment_details')->pluck('id')->toArray();
    $enrolls = Enroll::whereIn('payment_id',$payments)->select('course_id','user_id','course_price','total','final_total','payment_id','approved','status')->get()->toArray();
    foreach ($enrolls as $enroll) {
        PaymentDetails::updateOrCreate(
            [
                'course_id' => $enroll['course_id'],
                'user_id' => $enroll['user_id'],
                'status' => $enroll['status'],
                'payment_number' => $enroll['payment_id']
            ],
            [
                'payment_id' => $enroll['payment_id'],
                'course_id' =>  $enroll['course_id'],
                'instructor_id' => null,
                'user_id' => $enroll['user_id'],
                'payment_number' => $enroll['payment_id'], // $payment->payment_number
                'course_name_en' => null,
                'course_name_ar' => null,
                'course_image_url' =>  null,
                'instructor_name_en' => null,
                'instructor_name_ar' => null,
                'user_name_en' => null,
                'user_name_ar' => null,
                'price' => $enroll['final_total'],
                'offer' => '',
                'final_price' =>  $enroll['final_total'],
                'status' => $enroll['status'],
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
});
Route::get('front',function(){
    return session('link');
});

Route::get('certificates', function () {
    $certificate_users = DB::connection('afaq_source')->table('mod_lms_certificate')->get();
    foreach ($certificate_users as $certificate_user) {
        UserCertificate::firstOrCreate([
            'user_id' => $certificate_user->user_id,
            'course_id' => $certificate_user->course_id,
        ], [
            'user_id' => $certificate_user->user_id,
            'course_id' => $certificate_user->course_id,
            'certificate_id' => $certificate_user->cert_design_id,
        ]);
    }
});
Route::get('delete-payments', function () {
    $payments = Payment::doesntHave('payment_details')->delete();
    return $payments;
});
Route::get('resolve/invoices', function () {
    $payments = Payment::where('status', 1)->where('approved', 1)->whereNull('invoice_number')->get();
    foreach ($payments as $payment) {
        $pay = Payment::where('id', '<', $payment->id)->whereNotNull('invoice_number')->latest('invoice_number')->first();
        if (Payment::where('invoice_number', $pay->invoice_number + 1)->exists()) {
            $payment->update([
                'invoice_number' => Payment::whereNull('deleted_at')->where('approved', 1)->count() + 1
            ]);
        } else {
            $payment->update([
                'invoice_number' => $pay->invoice_number + 1
            ]);
        }
    }
    return $payments;
});
Route::get('setInvoiceNumber', function () {
    $payments = Payment::where('approved', 1)->get();
    $number = 0;
    foreach ($payments as $value) {

        $value->update([
            'invoice_number' => $number + 1
        ]);

        $number++;
    }
});
Route::get('/migrate/old', function () {
    // UsersMigration::usersMigrate();
    // CoursesMigration::courseMigration();
    // CoursesMigration::resolveCourse();
    // CoursesMigration::sections();
    // CoursesMigration::questionBank();
    // CoursesMigration::lectures();
    // CoursesMigration::resolveLecture();
    // CoursesMigration::partener();
    // CoursesMigration::specialities();
    // PaymentsMigration::paymentsMigrate();
    // PaymentsMigration::paymentDetials();
    // PaymentsMigration::enrolls();
    // PaymentsMigration::bankTransfer();
    // PaymentsMigration::userCourses();
    // CoursesMigration::couponMigrate();
    // CoursesMigration::courseCoupons();
    // UsersMigration::students();
    // UsersMigration::instructors();
    // PaymentsMigration::userCourses();
    // RolesMigration::rolesMigrate();
    // MigrateUserSpeciality::execute();
    // PaymentsMigration::userCourses();
    // CoursesMigration::userCourseProgress();
    CoursesMigration::solve_sub_spec();


});

Route::get('setCourseName', function () {
    $payment_detials = PaymentDetails::whereNull('course_name_en')->orWhereNull('course_name_ar')->get();
    foreach ($payment_detials as $payment_detial) {
        $course = Course::find($payment_detial->course_id);

        if ($course) {
            $payment_detial->course_name_en = $course->name_en;
            $payment_detial->course_name_ar = $course->name_ar;
            $payment_detial->save();
        }
    }
});

Route::get('/hyber', function () {
    return view('hyber');
});



// Route::post('/broadcasting/auth', 'PusherAuthController@authenticate');

// Route::get('/private-channel', function () {
//     return view('private-channel');
// });


Route::get('/start', function () {

    // $map_payments_detials =[
    //     'invoice_id' => 'payment_id',
    //     'product_id' => 'course_id',
    //     'price' => 'total',
    //     'final_price' => 'final_total',
    // ];

    // $map_payments =[
    //     'payment_method' => 'provider',
    //     'customer_id' => 'user_id',
    //     'total' => 'amount',
    //     'extra_data' => 'fullresponse'
    // ];


    // $course_mapped = [
    //     'startdate'=>'start_date',
    //     'enddate'=>'end_date',
    //     'start_registration_date'=>'start_register_date',
    //     'end_registration_date'=>'end_register_date',
    //     'accreditation_status'=>'accreditation',
    //     'title'=>'name_ar',
    //     'en_title'=>'name_en',
    //     'place'=>'course_place',
    //     'seats'=>'seating_number',
    //     'hours'=>'lecture_hours',
    //     'type' => 'training_type',
    //     'body' =>'description_en',
    //     'requirements' =>'requirements_en'
    // ];

    // $user_mapped = [
    //     'username'=>'user_name',
    //     'country'=>'birth_country',
    //     'ID_type' =>'identity_type',
    //     'ID_number' =>'identity_number',
    //     'fullname' =>'full_name_ar',
    //     'fullname' =>'full_name_en',
    // ];

    // $bank_map = [
    //     'payment_id' => 'invoice_id',
    //     'payer' => 'bank_name',
    //     'account_number' => 'bank_number',
    //     'payment_date' => 'date',
    //     'total' => 'amount',
    //     'account_number' => 'bank_number',
    // ];

    $course_mapped = [
        'section_id' => 'course_section_id',
        'instance_id' => 'title_en'
    ];
    // $res = Loader::apply($map_payments_detials , 'mod_sales_invoice_item' , 'enrolls');
    // $res = Loader::apply($mapped , 'mod_sales_invoice_coupon' , 'invvoice_coupon');
    // $res = Loader::apply($mapped , 'mod_sales_invoice' , 'invoices');
    // $res = Loader::apply($user_mapped , 'user' , 'users_src');
    // $res = Loader::apply($course_mapped , 'mod_lms_course' , 'courses');

    $res = Loader::apply($course_mapped, 'mod_lms_activity', 'course_section_lectures');
    dd($res);

    return view('start');
});

Route::get('tabby',function(){
    $tabby = (new Tabby)->checkout();

    return $tabby;
});
Route::redirect('/', '/en/homepage');
Route::get('/register', function () {
    return redirect("/en/register");
});




Route::get('/login', function () {
    return redirect("/en/login");
});
/** New Register  */

Route::get('/new_register', function () {
    return redirect("/en/new_register");
});
/** New Login */
Route::get('/new_login', function () {
    return redirect("/en/new_login");
});
/** New forget  */
Route::get('/password/new_forgot', function () {
    return redirect("/en/password/new_forgot");
});



Route::get('/password/reset', function () {
    return redirect("/en/password/reset");
});

Route::get('/password/forgot', function () {
    return redirect("/en/password/forgot");
});

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
/******* global routes */
Route::post('/getHash', 'Front\Content\CoursesController@getHash')->name('getHash');

Route::group(['prefix' => '{locale?}'], function () {

    Route::resource('notifications', 'NotificationsController');
    Route::post('read_notification', 'NotificationsController@markNotification');

    Route::get('course/{id}', 'LandingPageController@get_course_landing_page')->name('get_course_landing_page');

    Auth::routes();
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');


    /* ** New register Business*/
    Route::get('registration', 'Front\AfaqBusiness\Auth\RegisterController@registration')->name('register-user');
    Route::post('custom-registration', 'Front\AfaqBusiness\Auth\RegisterController@customRegistration')->name('register.custom');
            /**New Login **/
    Route::get('new_login', 'Front\AfaqBusiness\Auth\LoginController@showLoginForm')->name('new_login');
    Route::post('custom-login','Front\AfaqBusiness\Auth\LoginController@customLogin')->name('login.custom');
    Route::get('forget', 'Front\AfaqBusiness\Auth\ForgotPasswordController@showForget')->name('forget');


    Route::get('/homepage', 'HomeController@index')->name('site-home');
    Route::get('/all-courses', 'AllCoursesController@index')->name('all-courses');
    Route::get('/business-home', 'Front\AfaqBusiness\AfaqBusinessHomeController@index')->name('business-home');
    Route::get('/business-contact-us', 'Front\AfaqBusiness\AfaqBusinessHomeController@BusinessContactUs')->name('BusinessContactUs');
    Route::get('/business-thanks', 'Front\AfaqBusiness\AfaqBusinessHomeController@thanks')->name('business-thanks');
    Route::get('/business-warning', 'Front\AfaqBusiness\AfaqBusinessHomeController@warning')->name('business-warning');
    Route::get('/business-error', 'Front\AfaqBusiness\AfaqBusinessHomeController@business_error')->name('business-error');
    Route::get('/business-content/{slug}', 'Front\AfaqBusiness\AfaqBusinessHomeController@pageContent')->name('BusinessPageContent');

    Route::get('/business-package_details', 'Front\AfaqBusiness\AfaqBusinessHomeController@package_details')->name('business-package_details');
    Route::get('/business-own_package', 'Front\AfaqBusiness\AfaqBusinessHomeController@own_package')->name('business-own_package');
    Route::get('/business-payment/package_id', 'Front\AfaqBusiness\AfaqBusinessHomeController@business_payment')->name('business-payment');
    Route::post('/becomeInstractor','HomeController@become_instructor')->name('become_instructor');
    Route::post('business-special-request','Front\AfaqBusiness\BusinessProfileController@business_special_request')->name('business_special_request');

    //
    Route::get('/afaq_archives', 'HomeController@afaq_archive')->name('afaq_archive');
    Route::get('/afaq_wishlists', 'WishlistController@index')->name('afaq_wishlist');
    // Route::get('/afaq_wishlists', 'WishlistController@index')->name('afaq_wishlist');
    Route::post('/add_fav', 'WishlistController@addCourseToWishList')->name('add_fav');
    Route::post('/rm_fav', 'WishlistController@removeCourseFromWishList')->name('rm_fav');





    Route::get('/all_business_blogs', 'Front\AfaqBusiness\AfaqBusinessHomeController@all_business_blogs');
    Route::get('/about_business', 'Front\AfaqBusiness\AfaqBusinessHomeController@about_business');

    Route::get('/sort-all-courses', 'AllCoursesController@index')->name('sort-all-courses');

    Route::get('/available-exams', 'AvailableExamController@index')->name('available-exams');

    Route::get('/one-courses/{courses_id}', 'OneCourseController@show')->name('one-courses')->middleware('user.complete_data');
    Route::get('/one-courses-new/{courses_id}', 'OneCourseController@showNew')->name('one-courses-new')->middleware('user.complete_data');
    Route::get('one-course/quize/{quize_id}', 'OneCourseController@quize')->name('one-course-quize')->middleware('user.complete_data');
    Route::post('one-course/quize/{quize_id}/answer', 'OneCourseController@quizeAnswar')->name('one-course-quize-answer')->middleware('user.complete_data');
    Route::post('one-course/video/{lecture_id}/result', 'OneCourseController@videoResult')->name('one-course-video-result')->middleware('user.complete_data');
    Route::get('one-course/zoom/{meeting_number}', 'OneCourseController@zoomViewer')->name('one-course-zoom');

    Route::middleware(['auth', 'course.access.content','user.complete_data'])->group(function () {
        Route::get('/one-courses/{course_id}/content/{section_id?}/{lecture_id?}', 'OneCourseController@content')->name('one-course-content');
        Route::post('/one-courses/questionaire/result', 'OneCourseController@questionaire_result')->name('questionaire.result');
    });
    Route::get('/contact-us', 'HomeController@contactUs')->name('contactUs');
    Route::get('/mobile-sliders', 'HomeController@get_mobile_sliders')->name('get_mobile_sliders');
    Route::get('/join-us', 'HomeController@joinus')->name('join_us');
    Route::get('/ideal_partner', 'HomeController@idealpartner')->name('ideal_partner');
    Route::get('/ideal_partner_details/{testimonials_id}', 'HomeController@idealpartner_details')->name('ideal_partner_details');

    Route::get('/content/{slug}', 'HomeController@pageContent')->name('pageContent');
    Route::get('/blogs/view/{article_id}', 'BlogsController@view');
    Route::get('/all-blogs', 'BlogsController@all_blogs');


    Route::get('get_specialty/{id}', 'Admin\SpecialtyController@get_specialty');
    Route::get('/membership', 'Admin\MembershipController@frontmembership')->name('membership');
    Route::get('/personal-infos', 'ProfileController@myprofile')->name('personal-infos');
    Route::post('subscribe_count/{id}',  'Admin\NewsletterController@subscribe_count');
    Route::get('/invoice/{payment_id}', 'ProfileController@printInvoice')->name('invoice.print');
    Route::post('newsletters/save', 'Admin\NewsletterController@subscribe')->name('news.save');
    Route::get('/complete_profile', 'ProfileController@complete_profile')->name('complete_profile');
    Route::get('get_city/{id}', 'ProfileController@get_city');
    //AFAQ Business Newsletters
    Route::post('business_news/save', 'Front\AfaqBusiness\AfaqBusinessHomeController@subscribe')->name('business_news.save');
    Route::get('/business-personal-infos', 'Front\AfaqBusiness\BusinessProfileController@businessProfile')->name('business-personal-infos');
    Route::get('/business_invoice/{payment_id}', 'Front\AfaqBusiness\BusinessProfileController@print_business_Invoice')->name('business_invoice.print');
    Route::get('/customize-now', 'Front\AfaqBusiness\BusinessProfileController@customize_now')->name('customize_now');



    Route::get('/faq', 'Admin\FaqQuestionController@frontfaq')->name('faq');
    Route::get('get_course_item_data/{id}/{payment_id?}', 'ProfileController@get_course_item_data')->name('get_course_item_data');
    Route::post('refund_course_action', 'ProfileController@refund_course_action')->name('refund_course_action')->middleware('auth');
});


/******* Auth routes */

Route::post('update_personal_photo', 'ProfileController@update_personal_photo')->name('update_personal_photo');
Route::group(['prefix' => '{locale?}', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    Route::get('cart_item/coupon/apply', '\App\Http\Controllers\CartController@apply_coupon_item')->name('coupon.apply_coupon_item');
    Route::get('carts/coupon/apply', '\App\Http\Controllers\CartController@apply_coupon')->name('coupon.apply');
    Route::get('cart_item/coupon/remove/{item_id}', '\App\Http\Controllers\CartController@remove_coupon_item')->name('coupon.remove');
    Route::get('carts/{course_id}', '\App\Http\Controllers\CartController@store');
    Route::get('carts/{course_id}/delete', '\App\Http\Controllers\CartController@destroy');


    Route::get('gotocourse/{course_id}', '\App\Http\Controllers\CartController@gotocourse');
    Route::get('/enroll/{course_id}', 'OneCourseController@enrol_course')->name('enrol_course');
    Route::get('/carts', '\App\Http\Controllers\CartController@index')->name('carts');
    Route::get('/choose_payment_methods', '\App\Http\Controllers\CartController@choose_payment_methods')->name('carts.payment_methods')->middleware('user.complete_data');
    Route::get('/change_payment_method', '\App\Http\Controllers\CartController@change_payment_method')->name('invoice.change_payment_method');


    Route::get('checkout/pay/error', '\App\Http\Controllers\CartController@checkout_error');
    Route::get('checkout/banktransfer/complete', '\App\Http\Controllers\CartController@banktransfer');
    Route::get('checkout/banktransfer/confirm', '\App\Http\Controllers\CartController@banktransfer_confirm_form')->name('confirm.invoice');
    Route::post('checkout/banktransfer/confirm', '\App\Http\Controllers\CartController@banktransfer_confirm')->name('bank.confirm');
    Route::post('checkout/banktransfer/byadmin', '\App\Http\Controllers\CartController@create_invoice_by_admin');
    Route::get('checkout/banktransfer/byadmin/complete', '\App\Http\Controllers\CartController@complete_invoice_by_admin');

    Route::get('checkout/pay/complete', '\App\Http\Controllers\CartController@checkout_complete');
    Route::get('checkout/{cart_id?}/{user_id?}', '\App\Http\Controllers\CartController@checkout');
    Route::get('checkout/{cart_id?}', '\App\Http\Controllers\CartController@checkout');
    Route::get('checkout_exam_complete/pay/complete', '\App\Http\Controllers\CartController@checkout_exam_complete');
    Route::get('/use-wallet', '\App\Http\Controllers\CartController@UseWallet')->name('use_user_wallet');
// Business payment checkout
    Route::get('business_checkout/{package_id?}/{user_id?}', 'Front\AfaqBusiness\AfaqBusinessHomeController@business_checkout');
    Route::get('pay_business_checkout/pay/complete', 'Front\AfaqBusiness\AfaqBusinessHomeController@business_checkout_complete');

    //Business Profile ////

    Route::get('business_profile', 'Front\AfaqBusiness\BusinessProfileController@businessProfile');

    Route::post('business_edit_profile', 'Front\AfaqBusiness\BusinessProfileController@business_edit_profile');
    Route::post('create_tickets', 'Front\AfaqBusiness\BusinessProfileController@create_tickets');

    Route::get('/business_packages', 'Front\AfaqBusiness\BusinessProfileController@business_packages')->name('business_packages');
    Route::get('/business_tickets', 'Front\AfaqBusiness\BusinessProfileController@business_tickets')->name('business_tickets');
    Route::get('/business_invoices', 'Front\AfaqBusiness\BusinessProfileController@business_invoices')->name('business_invoices');


    ///////////////////////
//////
    Route::get('myprofile', 'ProfileController@myprofile');

    Route::get('my_invoices', 'ProfileController@myinvoices');

    Route::post('edit_myprofile', 'ProfileController@edit_myprofile');


    Route::get('mymembers', 'ProfileController@mymembers');
    Route::post('add_mymembers', 'ProfileController@add_mymembers');

    Route::get('mycourses', 'ProfileController@mycourses')->name('my_courses');
    Route::get('my_quizes', 'ProfileController@myquizes')->name('my_quizes');
    Route::get('my_tickets', 'ProfileController@mytickets')->name('my_tickets');
    Route::post('add_tickets', 'ProfileController@add_tickets');


    Route::get('mycourses/refund/{course_id}', 'ProfileController@make_refund');
    Route::get('wallet', 'ProfileController@wallet');

    Route::post('invite-friend', 'PointsController@InvitePoint')->name('invite-friend');
    Route::post('redeem-point', 'PointsController@RedeemPoint')->name('redeem-point');

    Route::get('my_certificates', '\App\Http\Controllers\Admin\MyCertificateController@index');
    Route::get('my_exams', '\App\Http\Controllers\Admin\MyexamController@index')->name('my_exams');

    Route::get('go-to-exam/{exam_id}', '\App\Http\Controllers\Admin\MyexamController@go_to_exam')->name('go-to-exam');
    Route::get('start_exam/{exam_id}', '\App\Http\Controllers\Admin\MyexamController@start_exam')->name('start_exam');

    Route::get('go-to-exam-results/{exam_id}', '\App\Http\Controllers\Admin\MyexamController@exam_results')->name('go-to-exam-results');
    Route::post('set_answer', '\App\Http\Controllers\Admin\MyexamController@set_answer')->name('set_answer');
    Route::get('get_reviews', '\App\Http\Controllers\Admin\MyexamController@get_reviews')->name('get_reviews');
    Route::get('end_exam', '\App\Http\Controllers\Admin\MyexamController@end_exam')->name('end_exam');
    Route::get('get_certificate', '\App\Http\Controllers\Admin\MyexamController@get_certificate')->name('get_certificate');
    Route::get('get_certificate_img', '\App\Http\Controllers\Admin\MyexamController@get_certificate_img')->name('get_certificate_img');
    Route::post('save_certificate', '\App\Http\Controllers\Admin\MyexamController@save_certificate')->name('save_certificate');
    Route::get('get_attendance_design/{course_id}/{attendance_design_id}', '\App\Http\Controllers\Admin\AttendanceDesignsController@get_attendance_design')->name('get_attendance_design');

    Route::get('changemypassword', 'ProfileController@changePasswordView');
    Route::post('changemypassword', 'ProfileController@change_mypassword')->name('change_password');
});




Route::get('/blogs/{category_id}', 'BlogsController@index');

Route::post('/enquiry_create', 'HomeController@enquiry_create')->name('enquiry_create');
Route::post('/business_enquiry', 'Front\AfaqBusiness\AfaqBusinessHomeController@businessEnquiry')->name('business_enquiry');
//Route::post('/business-special-request','Front\AfaqBusiness\BusinessProfileController@business_special_request')->name('business_special_request');
Route::post('business-special-request','Front\AfaqBusiness\BusinessProfileController@business_special_request')->name('business_special_request');


Route::post('/comment_create', 'BlogsController@comment_create')->name('comment_create');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
Route::post('job-applications/media', 'JobApplicationsController@storeMedia')->name('job-applications.storeMedia');
Route::post('job-applications/ckmedia', 'JobApplicationsController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
Route::get('job-applications', 'JobApplicationsController@create');


// KG 27/01 Start
Route::get('/events-registeration', 'Auth\RegisterController@eventsRegisteration')->name('eventsRegisteration');
Route::post('/eventsRegisterationSave', 'Auth\RegisterController@register')->name('eventsRegisterationSave');
// KG 27/01 ENd
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Route::group(['namespace' => 'Admin', 'middleware' => []], function () {
    Route::get('certificate-view', 'MyexamController@viewCertificate')->name('view.certificate');
    Route::get('attendance_card-view', 'AttendanceDesignsController@viewAttendanceCard')->name('view.attendance_card');

});

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => []], function () {
    Route::post('/users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('/approval', 'ApprovalController@index')->name('users.approval');
    Route::post('/disapproval', 'ApprovalController@finaldisapproval')->name('users.disapproval');

    // Ajax on system emails

    Route::post('/system-emails-search', 'SystemEmailsController@search')->name('system-emails.search');
    Route::get('DeleteReservationInvoices', 'ReservationsController@DeleteReservation');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('users/export','UsersController@export')->name('users.export');

    // Zoom Meeting
    Route::get('zoom-meetings/report/{meeting_id}', 'ZoomMeetingController@reports')->name('zoom-meetings.report');
    Route::delete('zoom-meetings/destroy', 'ZoomMeetingController@massDestroy')->name('zoom-meetings.massDestroy');
    Route::post('zoom-meetings/media', 'ZoomMeetingController@storeMedia')->name('zoom-meetings.storeMedia');
    Route::post('zoom-meetings/ckmedia', 'ZoomMeetingController@storeCKEditorImages')->name('zoom-meetings.storeCKEditorImages');
    Route::resource('zoom-meetings', 'ZoomMeetingController');


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/verify', 'UsersController@verify')->name('users.verify');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');
    Route::get('getUsers', 'UsersController@getUsers')->name('users.getUsers');
    Route::post('getUserWallet', 'UsersController@getUserWallet')->name('users.getUserWallet');

    // Lectures
    Route::delete('lectures/destroy', 'LecturesController@massDestroy')->name('lectures.massDestroy');
    Route::post('lectures/media', 'LecturesController@storeMedia')->name('lectures.storeMedia');
    Route::post('lectures/ckmedia', 'LecturesController@storeCKEditorImages')->name('lectures.storeCKEditorImages');
    Route::resource('lectures', 'LecturesController');

    // SystemEmails
    Route::delete('system-emails/destroy', 'SystemEmailsController@massDestroy')->name('system-emails.massDestroy');
    Route::post('system-emails/media', 'SystemEmailsController@storeMedia')->name('system-emails.storeMedia');
    Route::post('system-emails/ckmedia', 'SystemEmailsController@storeCKEditorImages')->name('system-emails.storeCKEditorImages');
    Route::resource('system-emails', 'SystemEmailsController');

    // UserLogs
    Route::delete('user-logs/destroy', 'UserLogsController@massDestroy')->name('user-logs.massDestroy');
    Route::post('user-logs/media', 'UserLogsController@storeMedia')->name('user-logs.storeMedia');
    Route::post('user-logs/ckmedia', 'UserLogsController@storeCKEditorImages')->name('user-logs.storeCKEditorImages');
    Route::resource('user-logs', 'UserLogsController');


    // Route::get('system-emails/testmail', 'SystemEmailsController@testmail')->name('system-emails.testmail');
    Route::get('testmail2', 'SystemEmailsController@testmail')->name('system-emails.testmail');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::get('faq_categories/sorting', 'FaqCategoryController@faq_cats_view')->name('faq_categories.view.sorting');
    Route::post('sorting/faq_categories', 'FaqCategoryController@sort_faq_cats')->name('faq_categories.sort');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::get('faq_questions/sorting', 'FaqQuestionController@faq_ques_view')->name('faq_questions.view.sorting');
    Route::post('sorting/faq_questions', 'FaqQuestionController@sort_faq_ques')->name('faq_questions.sort');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Payments
    Route::resource('payments', 'PaymentController', ['except' => ['destroy']]);
    Route::get('lectures-payments', 'PaymentController@lectures')->name('payments.lectures');

    // Pay Nows
    Route::get('store-payments', 'PaymentController@add')->name('payments.add-store');
    Route::get('payment/cancel', 'PaymentController@cancel')->name('payments.cancel');
    Route::get('payment/error', 'PaymentController@error')->name('payments.error');
    Route::post('pay-nows', 'PayNowController@index');
    // Route::resource('pay-nows', 'PayNowController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('unpaid/send-email', 'UnpaidApplicantsController@index')->name('unpaid.send');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

    Route::get('binding-student', 'bindingController@index')->name('student.binding');
    Route::get('Unchecked-student', 'UncheckedController@index')->name('student.Unchecked');
    Route::get('withdrawal-student', 'withdrawalController@index')->name('student.withdrawal');
    Route::get('approved-student', 'approvedController@index')->name('student.approved');
    Route::get('disapproved-student', 'disapprovedController@index')->name('student.disapproved');
    Route::get('Unverified-student', 'UnverifiedController@index')->name('student.Unverified');

    Route::get('Unchecked-visitor', 'UncheckedController@visitors')->name('visitor.Unchecked');
    Route::get('approved-visitor', 'approvedController@visitors')->name('visitor.approved');
    Route::get('Unverified-visitor', 'UnverifiedController@visitors')->name('visitor.Unverified');

    // KG Start
    Route::get('payment', 'PaypalController@index');
    Route::post('charge', 'PaypalController@charge');
    Route::get('paymentsuccess', 'PaypalController@payment_success');
    Route::get('paymenterror', 'PaypalController@payment_error');
    // KG End

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');
    // Home Page Slider
    Route::delete('home-page-sliders/destroy', 'HomePageSliderController@massDestroy')->name('home-page-sliders.massDestroy');
    Route::post('home-page-sliders/media', 'HomePageSliderController@storeMedia')->name('home-page-sliders.storeMedia');
    Route::post('home-page-sliders/ckmedia', 'HomePageSliderController@storeCKEditorImages')->name('home-page-sliders.storeCKEditorImages');
    Route::resource('home-page-sliders', 'HomePageSliderController');

    // Snippet
    Route::delete('snippets/destroy', 'SnippetController@massDestroy')->name('snippets.massDestroy');
    Route::post('snippets/media', 'SnippetController@storeMedia')->name('snippets.storeMedia');
    Route::post('snippets/ckmedia', 'SnippetController@storeCKEditorImages')->name('snippets.storeCKEditorImages');
    Route::resource('snippets', 'SnippetController');

    // Founders
    Route::delete('founders/destroy', 'FoundersController@massDestroy')->name('founders.massDestroy');
    Route::post('founders/media', 'FoundersController@storeMedia')->name('founders.storeMedia');
    Route::post('founders/ckmedia', 'FoundersController@storeCKEditorImages')->name('founders.storeCKEditorImages');
    Route::resource('founders', 'FoundersController');

    // Coming Soon
    Route::delete('coming-soons/destroy', 'ComingSoonController@massDestroy')->name('coming-soons.massDestroy');
    Route::post('coming-soons/media', 'ComingSoonController@storeMedia')->name('coming-soons.storeMedia');
    Route::post('coming-soons/ckmedia', 'ComingSoonController@storeCKEditorImages')->name('coming-soons.storeCKEditorImages');
    Route::resource('coming-soons', 'ComingSoonController');

    // Enquiries
    Route::delete('enquiries/destroy', 'EnquiriesController@massDestroy')->name('enquiries.massDestroy');
    Route::resource('enquiries', 'EnquiriesController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Blogs
    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogsController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogsController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogsController');
    // Blogscomments
    Route::delete('blogscomments/destroy', 'BlogscommentsController@massDestroy')->name('blogscomments.massDestroy');
    Route::post('blogscomments/media', 'BlogscommentsController@storeMedia')->name('blogscomments.storeMedia');
    Route::post('blogscomments/ckmedia', 'BlogscommentsController@storeCKEditorImages')->name('blogscomments.storeCKEditorImages');
    Route::resource('blogscomments', 'BlogscommentsController');
    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::post('jobs/media', 'JobsController@storeMedia')->name('jobs.storeMedia');
    Route::post('jobs/ckmedia', 'JobsController@storeCKEditorImages')->name('jobs.storeCKEditorImages');
    Route::resource('jobs', 'JobsController');

    // Job Applications
    Route::delete('job-applications/destroy', 'JobApplicationsController@massDestroy')->name('job-applications.massDestroy');
    Route::post('job-applications/media', 'JobApplicationsController@storeMedia')->name('job-applications.storeMedia');
    Route::post('job-applications/ckmedia', 'JobApplicationsController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
    Route::resource('job-applications', 'JobApplicationsController');
    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    // Route::post('sliders/reorder', 'SliderController@reorder')->name('sliders.reorder');
    Route::get('sliders/sorting', 'SliderController@slidersView')->name('sliders.view.sorting');
    Route::post('sorting/sliders', 'SliderController@sortSliders')->name('sliders.sort');
    Route::resource('sliders', 'SliderController');

    // Slider Cards
    Route::delete('slider-cards/destroy', 'SliderCardsController@massDestroy')->name('slider-cards.massDestroy');
    Route::post('slider-cards/media', 'SliderCardsController@storeMedia')->name('slider-cards.storeMedia');
    Route::post('slider-cards/ckmedia', 'SliderCardsController@storeCKEditorImages')->name('slider-cards.storeCKEditorImages');
    Route::resource('slider-cards', 'SliderCardsController');

    // Icon Text
    Route::delete('icon-texts/destroy', 'IconTextController@massDestroy')->name('icon-texts.massDestroy');
    Route::post('icon-texts/media', 'IconTextController@storeMedia')->name('icon-texts.storeMedia');
    Route::post('icon-texts/ckmedia', 'IconTextController@storeCKEditorImages')->name('icon-texts.storeCKEditorImages');
    Route::resource('icon-texts', 'IconTextController');

    // Partner
    Route::delete('partners/destroy', 'PartnerController@massDestroy')->name('partners.massDestroy');
    Route::post('partners/media', 'PartnerController@storeMedia')->name('partners.storeMedia');
    Route::post('partners/ckmedia', 'PartnerController@storeCKEditorImages')->name('partners.storeCKEditorImages');
    Route::resource('partners', 'PartnerController');

    // Icon Text Des
    Route::delete('icon-text-des/destroy', 'IconTextDesController@massDestroy')->name('icon-text-des.massDestroy');
    Route::post('icon-text-des/media', 'IconTextDesController@storeMedia')->name('icon-text-des.storeMedia');
    Route::post('icon-text-des/ckmedia', 'IconTextDesController@storeCKEditorImages')->name('icon-text-des.storeCKEditorImages');
    Route::resource('icon-text-des', 'IconTextDesController');

    // Editor
    Route::delete('editors/destroy', 'EditorController@massDestroy')->name('editors.massDestroy');
    Route::post('editors/media', 'EditorController@storeMedia')->name('editors.storeMedia');
    Route::post('editors/ckmedia', 'EditorController@storeCKEditorImages')->name('editors.storeCKEditorImages');
    Route::resource('editors', 'EditorController');
    // Instructor
    Route::delete('instructors/destroy', 'InstructorController@massDestroy')->name('instructors.massDestroy');
    Route::post('instructors/media', 'InstructorController@storeMedia')->name('instructors.storeMedia');
    Route::post('instructors/ckmedia', 'InstructorController@storeCKEditorImages')->name('instructors.storeCKEditorImages');
    Route::get('instructors/sorting', 'InstructorController@instructors_view')->name('instructors.view.sorting');
    Route::post('sorting/instructors', 'InstructorController@sort_instructor')->name('instructors.sort');
    Route::resource('instructors', 'InstructorController');

    // Student Moodle
    Route::delete('student-moodles/destroy', 'StudentMoodleController@massDestroy')->name('student-moodles.massDestroy');
    Route::post('student-moodles/media', 'StudentMoodleController@storeMedia')->name('student-moodles.storeMedia');
    Route::post('student-moodles/ckmedia', 'StudentMoodleController@storeCKEditorImages')->name('student-moodles.storeCKEditorImages');
    Route::resource('student-moodles', 'StudentMoodleController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::get('ChangeStatusCourse', 'CoursesController@ChangePublish');
    Route::get('courses/sorting', 'CoursesController@courseView')->name('courses.view.sorting');
    Route::post('sorting/courses', 'CoursesController@sortCourses')->name('courses.sort');
    Route::resource('courses', 'CoursesController');
    Route::get('courses/{course_id}/course-content', 'CoursesController@content')->name('courses.course-content');
    Route::resource('courses/{course_id}/prices', 'CoursePriceController')->names([
        'index' => 'courses.prices.index',
        'store' => 'courses.prices.store',
        'create' => 'courses.prices.create',
        'update' => 'courses.prices.update',
    ])->parameters([
        'courses' => "course_id"
    ]);

    // Course Sections
    Route::resource('course-sections', 'CourseSectionsController')->names([
        'index' => 'courses.course-sections.index',
        'store' => 'courses.course-sections.store',
        'create' => 'courses.course-sections.create',
        'update' => 'courses.course-sections.update',
        'destroy' => 'courses.course-sections.destroy'
    ]);

    // Course Section Lectures
    Route::post('courses/sections/lecture/media', 'CourseSectionLecturesController@storeMedia')->name('courses.course-section-lectures.storeMedia');
    Route::post('courses/sections/lecture/sorting', 'CourseSectionLecturesController@sorting')->name('courses.course-section-lectures.sorting');
    Route::match(['GET', 'POST'], 'courses/sections/lecture/dependsOn', 'CourseSectionLecturesController@dependsOn')->name('courses.course-section-lectures.dependsOn');
    Route::get('courses/sections/lecture/notes', 'CourseSectionLecturesController@notes')->name('courses.course-section-lectures.notes');
    Route::post('courses/sections/lecture/notes/store', 'CourseSectionLecturesController@notesStore')->name('courses.course-section-lectures.notes.store');

    Route::resource('course-section-lectures', 'CourseSectionLecturesController')->names([
        'index' => 'courses.course-section-lectures.index',
        'store' => 'courses.course-section-lectures.store',
        'create' => 'courses.course-section-lectures.create',
        'update' => 'courses.course-section-lectures.update',
        'destroy' => 'courses.course-section-lectures.destroy',
        'show' => 'courses.course-section-lectures.show'
    ]);

    Route::post('courses/questionaire/media', 'CourseQuestionaireController@storeMedia')->name('courses.course-questionaire.storeMedia');
    Route::resource('courses/{course_id}/course-questionaire', 'CourseQuestionaireController')->names([
        'index' => 'courses.course-questionaire.index',
        'store' => 'courses.course-questionaire.store',
        'create' => 'courses.course-questionaire.create',
        'update' => 'courses.course-questionaire.update',
        'destroy' => 'courses.course-questionaire.destroy',
    ]);

    Route::get('courses/{course_id}/course-questionaire/show', 'CourseQuestionaireController@show')->name('courses.course-questionaire.show');
    Route::get('courses/{course_id}/course-questionaires/showindex', 'CourseQuestionaireController@showIndex')->name('courses.course-questionaire.show.index');

    Route::get('courses/{course_id}/course-questionaire/show/result/{user_id}', 'CourseQuestionaireController@show_result')->name('courses.course-questionaire.show.result');
    Route::get('ChangeStatusReview', 'CourseQuestionaireController@ChangeStatusReview');

    // Course Category
    Route::delete('course-categories/destroy', 'CourseCategoryController@massDestroy')->name('course-categories.massDestroy');
    Route::get('ChangeFeature', 'CourseCategoryController@ChangeFeatured');
    Route::resource('course-categories', 'CourseCategoryController');
    // Specialty
    Route::delete('specialties/destroy', 'SpecialtyController@massDestroy')->name('specialties.massDestroy');
    Route::get('specialties/sorting', 'SpecialtyController@specialtiesView')->name('specialties.view.sorting');
    Route::post('sorting/specialties', 'SpecialtyController@sortSpecialties')->name('specialties.sort');
    Route::resource('specialties', 'SpecialtyController');
    // Sub Specialty
    Route::delete('sub-specialties/destroy', 'SubSpecialtyController@massDestroy')->name('sub-specialties.massDestroy');
    Route::resource('sub-specialties', 'SubSpecialtyController');

    // sync-categories ,sync-courses
    Route::get('sync-categories', 'CourseCategoryController@sync_categories_from_moodle')->name('course-categories.sync');
    Route::get('sync-cources', 'CoursesController@sync_courses_from_moodle')->name('course-cources.sync');
    Route::get('sync-users', 'UsersController@sync_users_from_moodle')->name('course-users.sync');

    // Coupon Code
    Route::delete('coupon-codes/destroy', 'CouponCodeController@massDestroy')->name('coupon-codes.massDestroy');
    Route::resource('coupon-codes', 'CouponCodeController');

    // Payment Methods
    Route::delete('payment-methods/destroy', 'PaymentMethodsController@massDestroy')->name('payment-methods.massDestroy');
    Route::post('payment-methods/media', 'PaymentMethodsController@storeMedia')->name('payment-methods.storeMedia');
    Route::post('payment-methods/ckmedia', 'PaymentMethodsController@storeCKEditorImages')->name('payment-methods.storeCKEditorImages');
    Route::post('sorting/methods', 'PaymentMethodsController@sort_method')->name('methods.sort');
    Route::get('methods/sorting', 'PaymentMethodsController@methods_view')->name('methods.view.sorting');

    Route::resource('payment-methods', 'PaymentMethodsController');

    // Accreditation Sponsor
    Route::delete('accreditation-sponsors/destroy', 'AccreditationSponsorController@massDestroy')->name('accreditation-sponsors.massDestroy');
    Route::post('accreditation-sponsors/media', 'AccreditationSponsorController@storeMedia')->name('accreditation-sponsors.storeMedia');
    Route::post('accreditation-sponsors/ckmedia', 'AccreditationSponsorController@storeCKEditorImages')->name('accreditation-sponsors.storeCKEditorImages');
    Route::resource('accreditation-sponsors', 'AccreditationSponsorController');

    // Universities
    Route::delete('universities/destroy', 'UniversitiesController@massDestroy')->name('universities.massDestroy');
    Route::post('universities/media', 'UniversitiesController@storeMedia')->name('universities.storeMedia');
    Route::post('universities/ckmedia', 'UniversitiesController@storeCKEditorImages')->name('universities.storeCKEditorImages');
    Route::resource('universities', 'UniversitiesController');

    // Hospitals
    Route::delete('hospitals/destroy', 'HospitalsController@massDestroy')->name('hospitals.massDestroy');
    Route::resource('hospitals', 'HospitalsController');

    Route::delete('membership-types/destroy', 'MembershipTypeController@massDestroy')->name('membership-types.massDestroy');
    Route::resource('membership-types', 'MembershipTypeController');

    // Membership
    Route::delete('memberships/destroy', 'MembershipController@massDestroy')->name('memberships.massDestroy');
    Route::post('memberships/media', 'MembershipController@storeMedia')->name('memberships.storeMedia');
    Route::post('memberships/ckmedia', 'MembershipController@storeCKEditorImages')->name('memberships.storeCKEditorImages');
    // Route::get('/memberships', 'MembershipController@frontmembership')->name('memberships');
    Route::resource('memberships', 'MembershipController');
    // User Membership
    Route::delete('user-memberships/destroy', 'UserMembershipController@massDestroy')->name('user-memberships.massDestroy');
    Route::post('user-memberships/media', 'UserMembershipController@storeMedia')->name('user-memberships.storeMedia');
    Route::post('user-memberships/ckmedia', 'UserMembershipController@storeCKEditorImages')->name('user-memberships.storeCKEditorImages');
    Route::resource('user-memberships', 'UserMembershipController');
    Route::get('ChangeStatusUserMembership', 'UserMembershipController@ChangeStatus');

    // Newsletter
    Route::delete('newsletters/destroy', 'NewsletterController@massDestroy')->name('newsletters.massDestroy');
    Route::resource('newsletters', 'NewsletterController');
    // Certificat
    Route::delete('certificats/destroy', 'CertificatController@massDestroy')->name('certificats.massDestroy');
    Route::post('certificats/media', 'CertificatController@storeMedia')->name('certificats.storeMedia');
    Route::post('certificats/ckmedia', 'CertificatController@storeCKEditorImages')->name('certificats.storeCKEditorImages');
    Route::resource('certificats', 'CertificatController');
    Route::get('generate_certificates/{course_id}/index', 'CertificatController@generate_certificates')->name('generate_certificates');


    // Exams Title
    Route::delete('exams-titles/destroy', 'ExamsTitleController@massDestroy')->name('exams-titles.massDestroy');
    Route::resource('exams-titles', 'ExamsTitleController');
    // Question Bank
    Route::delete('question-banks/destroy', 'QuestionBankController@massDestroy')->name('question-banks.massDestroy');
    Route::resource('question-banks', 'QuestionBankController');

    // Certificate Key
    Route::delete('certificate-keys/destroy', 'CertificateKeyController@massDestroy')->name('certificate-keys.massDestroy');
    Route::resource('certificate-keys', 'CertificateKeyController');
    Route::get('keys-data', 'CertificateKeyController@get_type_data')->name('certificate-keys.data_type');

    // Exam
    Route::delete('exams/destroy', 'ExamController@massDestroy')->name('exams.massDestroy');
    Route::post('exams/media', 'ExamController@storeMedia')->name('exams.storeMedia');
    Route::post('exams/ckmedia', 'ExamController@storeCKEditorImages')->name('exams.storeCKEditorImages');
    Route::resource('exams', 'ExamController');
    // Course Price
    Route::delete('course-prices/destroy', 'CoursePriceController@massDestroy')->name('course-prices.massDestroy');
    Route::resource('course-prices', 'CoursePriceController');
    // Cancelation Policy
    Route::delete('cancelation-policies/destroy', 'CancelationPolicyController@massDestroy')->name('cancelation-policies.massDestroy');
    Route::resource('cancelation-policies', 'CancelationPolicyController');
    // Reservations
    Route::resource('reservations', 'ReservationsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::get('ChangeStatusReservation', 'ReservationsController@ChangeStatus');
    Route::get('wallet_transaction', 'ReservationsController@index')->name('reservations.wallet_transactions');
    Route::get('show-canceled/{id}', 'ReservationsController@show_canceled')->name('reservations.canceled');
    Route::get('reservation/cancelPage/{payment_id}', 'ReservationsController@cancelPage')->name('reservation.cancelPage');
    Route::post('reservation/cancel/{payment_id}', 'ReservationsController@cancel')->name('reservation.cancel');
    // Enrollment
    //    Route::delete('enrollments/destroy', 'EnrollmentController@massDestroy')->name('enrollments.massDestroy');
    Route::resource('enrollments', 'EnrollmentController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    // Bank List
    Route::delete('bank-lists/destroy', 'BankListController@massDestroy')->name('bank-lists.massDestroy');
    Route::resource('bank-lists', 'BankListController');
    // Course Invoices
    Route::delete('course-invoices/destroy', 'CourseInvoicesController@massDestroy')->name('course-invoices.massDestroy');
    Route::post('course-invoices/media', 'CourseInvoicesController@storeMedia')->name('course-invoices.storeMedia');
    Route::post('course-invoices/ckmedia', 'CourseInvoicesController@storeCKEditorImages')->name('course-invoices.storeCKEditorImages');
    Route::get('unPaidInvoices', 'CourseInvoicesController@index')->name('course-invoices.unPaidInvoices');

    Route::resource('course-invoices', 'CourseInvoicesController');
    // Course Configration
    Route::delete('course-configrations/destroy', 'CourseConfigrationController@massDestroy')->name('course-configrations.massDestroy');
    Route::resource('course-configrations', 'CourseConfigrationController');

    // Lookups
    Route::get('course-lists/{type_slug}/index', 'LookupsController@index')->name('lookups.index');
    Route::get('course-lists/{type_slug}/create', 'LookupsController@create')->name('lookups.create');
    Route::get('course-lists/{type_slug}/update/{id}', 'LookupsController@edit')->name('lookups.edit');
    Route::post('course-lists/{type_slug}/store', 'LookupsController@store')->name('lookups.store');
    Route::put('course-lists/{type_slug}/update/{id}', 'LookupsController@update')->name('lookups.update');
    Route::delete('course-lists/{type_slug}/delete', 'LookupsController@destroy')->name('lookups.delete');
    Route::post('course-lists/media', 'CertificatController@storeMedia')->name('lookups.storeMedia');
    // Courses User
    Route::delete('course-users/destroy', 'CoursesUserController@massDestroy')->name('course-users.massDestroy');
    Route::get('course-users/report/{course_id}', 'CoursesUserController@course_invoice_report')->name('course_invoice_report');

    Route::resource('course-users', 'CoursesUserController');
    Route::get('export_course_users/{course_user}','CoursesUserController@export_course_users')->name('export_course_users');
    // User Courses
    Route::delete('user-courses/destroy', 'UserCoursesController@massDestroy')->name('user-courses.massDestroy');
    Route::resource('user-courses', 'UserCoursesController');
// Wallet
    Route::delete('wallets/destroy', 'WalletController@massDestroy')->name('wallets.massDestroy');
    Route::get('AddWalletBalance', 'WalletController@addBalance');
    Route::get('SubWalletBalance', 'WalletController@subBalance');
//    Route::get('wallet-transactions', 'WalletController@index')->name('wallets.wallet-transactions');
    Route::resource('wallets', 'WalletController');
    // Coupon Code Courses
    Route::delete('coupon-code-courses/destroy', 'CouponCodeCoursesController@massDestroy')->name('coupon-code-courses.massDestroy');
    Route::resource('coupon-code-courses', 'CouponCodeCoursesController');
    // Course Quize
    Route::delete('course-quizes/destroy', 'CourseQuizeController@massDestroy')->name('course-quizes.massDestroy');
    Route::post('course-quizes/media', 'CourseQuizeController@storeMedia')->name('course-quizes.storeMedia');
    Route::post('course-quizes/ckmedia', 'CourseQuizeController@storeCKEditorImages')->name('course-quizes.storeCKEditorImages');
    Route::get('course-quizes/{course_id}/index', 'CourseQuizeController@index')->name('course-quizes.index');
    Route::get('course-quizes/{course_id}/create', 'CourseQuizeController@create')->name('course-quizes.create');
    Route::get('course-quizes/{course_id}/update/{id}', 'CourseQuizeController@edit')->name('course-quizes.edit');
    Route::get('course-quizes/{course_id}/show/{id}', 'CourseQuizeController@show')->name('course-quizes.show');
    Route::get('course-quizes/{course_id}/quize_result/{id}', 'CourseQuizeController@results')->name('course-quizes.results');
    Route::post('course-quizes/{course_id}/store', 'CourseQuizeController@store')->name('course-quizes.store');
    Route::put('course-quizes/{course_id}/update/{id}', 'CourseQuizeController@update')->name('course-quizes.update');
    Route::delete('course-quizes/{course_id}/delete', 'CourseQuizeController@destroy')->name('course-quizes.delete');
    //AFAQ Testimonials
    Route::delete('testimonials/destroy', 'TestimonialsController@massDestroy')->name('testimonials.massDestroy');
    Route::post('testimonials/media', 'TestimonialsController@storeMedia')->name('testimonials.storeMedia');
    Route::post('testimonials/ckmedia', 'TestimonialsController@storeCKEditorImages')->name('testimonials.storeCKEditorImages');
    Route::resource('testimonials', 'TestimonialsController');
    //AFAQ  User Notification
    Route::delete('user-notifications/destroy', 'UserNotificationController@massDestroy')->name('user-notifications.massDestroy');
    Route::resource('user-notifications', 'UserNotificationController');
    //AFAQ  Notification Campain
    Route::delete('notification-campains/destroy', 'NotificationCampainController@massDestroy')->name('notification-campains.massDestroy');
    Route::resource('notification-campains', 'NotificationCampainController');
    // Cancel Payment
    Route::delete('cancel-payments/destroy', 'CancelPaymentController@massDestroy')->name('cancel-payments.massDestroy');
    Route::get('cancelcourse/confirm', 'CancelPaymentController@store')->name('cancel.confirm');
    Route::get('CancelCourseReservation', 'CancelPaymentController@DeleteCourseReservation');
    Route::resource('cancel-payments', 'CancelPaymentController');
    Route::post('cancel-payment/{payment_id}','ReservationsController@cancel_payment')->name('reservations.cancel_payment_front');
    // Cancel Request
    Route::delete('cancel-requests/destroy', 'CancelRequestController@massDestroy')->name('cancel-requests.massDestroy');
    Route::resource('cancel-requests', 'CancelRequestController', ['except' => ['create', 'store', 'edit', 'update']]);
    Route::post('cancel-request/verify','CancelRequestController@verify')->name('cancel-request.verify');
    // Point Type
    Route::delete('point-types/destroy', 'PointTypeController@massDestroy')->name('point-types.massDestroy');
    Route::resource('point-types', 'PointTypeController');

    // Point Type Value
    Route::delete('point-type-values/destroy', 'PointTypeValueController@massDestroy')->name('point-type-values.massDestroy');
    Route::resource('point-type-values', 'PointTypeValueController');
    // Point Data
    Route::delete('points/destroy', 'PointController@massDestroy')->name('points.massDestroy');
    Route::get('AddPointBalance', 'PointController@addPoint');
    Route::get('SubPointBalance', 'PointController@subPoint');
    Route::resource('points', 'PointController', ['except' => ['create', 'store', 'edit', 'update']]);
    // Point Actions
    Route::delete('point-actions/destroy', 'PointActionsController@massDestroy')->name('point-actions.massDestroy');
    Route::resource('point-actions', 'PointActionsController', ['except' => ['create', 'store', 'edit', 'update']]);
    // Attendance Designs
    Route::delete('attendance-designs/destroy', 'AttendanceDesignsController@massDestroy')->name('attendance-designs.massDestroy');
    Route::post('attendance-designs/media', 'AttendanceDesignsController@storeMedia')->name('attendance-designs.storeMedia');
    Route::post('attendance-designs/ckmedia', 'AttendanceDesignsController@storeCKEditorImages')->name('attendance-designs.storeCKEditorImages');
    Route::resource('attendance-designs', 'AttendanceDesignsController');
    Route::get('generate_attendance_designs/{course_id}/index', 'AttendanceDesignsController@generate_attendance_designs')->name('generate_attendance_designs');
//    Route::get('get_attendance_design/{course_id}/{attendance_design_id}', '\App\Http\Controllers\Admin\AttendanceDesignsController@get_attendance_design')->name('get_attendance_design');
    Route::get('get_certificate_img', '\App\Http\Controllers\Admin\AttendanceDesignsController@get_certificate_img')->name('get_certificate_img');
    Route::post('save_attendance_design', '\App\Http\Controllers\Admin\AttendanceDesignsController@save_attendance_design')->name('save_attendance_design');
    //Attend , leave Course
    Route::post('attend_course', '\App\Http\Controllers\Admin\AttendanceDesignsController@attend_course')->name('attend_course');
    Route::post('leave_course', '\App\Http\Controllers\Admin\AttendanceDesignsController@leave_course')->name('leave_course');



    // Attendance Design Keys
    Route::delete('attendance-design-keys/destroy', 'AttendanceDesignKeysController@massDestroy')->name('attendance-design-keys.massDestroy');
    Route::get('attendance_keys-data', 'AttendanceDesignKeysController@get_type_data')->name('attendance-keys.data_type');

    Route::resource('attendance-design-keys', 'AttendanceDesignKeysController');
    // Tickets
    Route::delete('tickets/destroy', 'TicketsController@massDestroy')->name('tickets.massDestroy');
    Route::post('tickets/media', 'TicketsController@storeMedia')->name('tickets.storeMedia');
//    Route::get('user_tickets', 'TicketsController@userTickets');
//    Route::post('ticket-comment', 'TicketCommentsController@postComment');
    Route::post('closeTicket/{ticket_id}', 'TicketsController@close_ticket')->name('tickets.close');

    Route::post('tickets/comment/{ticket}', 'TicketsController@storeComment')->name('tickets.storeComment');
    Route::post('business_tickets/comment/{ticket}', 'TicketsController@storeBusinessComment')->name('tickets.storeBusinessComment');

    Route::post('tickets/ckmedia', 'TicketsController@storeCKEditorImages')->name('tickets.storeCKEditorImages');
    Route::resource('tickets', 'TicketsController');

    // Ticket Category
    Route::delete('ticket-categories/destroy', 'TicketCategoryController@massDestroy')->name('ticket-categories.massDestroy');
    Route::resource('ticket-categories', 'TicketCategoryController');
    // Ticket Comments
    Route::delete('ticket-comments/destroy', 'TicketCommentsController@massDestroy')->name('ticket-comments.massDestroy');
    Route::resource('ticket-comments', 'TicketCommentsController');
    // User Attendance
    Route::delete('user-attendances/destroy', 'UserAttendanceController@massDestroy')->name('user-attendances.massDestroy');
    Route::resource('user-attendances', 'UserAttendanceController');
    // Business Banner
    Route::delete('business-banners/destroy', 'BusinessBannerController@massDestroy')->name('business-banners.massDestroy');
    Route::post('business-banners/media', 'BusinessBannerController@storeMedia')->name('business-banners.storeMedia');
    Route::post('business-banners/ckmedia', 'BusinessBannerController@storeCKEditorImages')->name('business-banners.storeCKEditorImages');
    Route::resource('business-banners', 'BusinessBannerController');

    // Business Need
    Route::delete('business-needs/destroy', 'BusinessNeedController@massDestroy')->name('business-needs.massDestroy');
    Route::post('business-needs/media', 'BusinessNeedController@storeMedia')->name('business-needs.storeMedia');
    Route::post('business-needs/ckmedia', 'BusinessNeedController@storeCKEditorImages')->name('business-needs.storeCKEditorImages');
    Route::resource('business-needs', 'BusinessNeedController');

    // Business Medical Type
    Route::delete('business-medical-types/destroy', 'BusinessMedicalTypeController@massDestroy')->name('business-medical-types.massDestroy');
    Route::post('business-medical-types/media', 'BusinessMedicalTypeController@storeMedia')->name('business-medical-types.storeMedia');
    Route::post('business-medical-types/ckmedia', 'BusinessMedicalTypeController@storeCKEditorImages')->name('business-medical-types.storeCKEditorImages');
    Route::resource('business-medical-types', 'BusinessMedicalTypeController');

    // Business Feature
    Route::delete('business-features/destroy', 'BusinessFeatureController@massDestroy')->name('business-features.massDestroy');
    Route::post('business-features/media', 'BusinessFeatureController@storeMedia')->name('business-features.storeMedia');
    Route::post('business-features/ckmedia', 'BusinessFeatureController@storeCKEditorImages')->name('business-features.storeCKEditorImages');
    Route::resource('business-features', 'BusinessFeatureController');

    // Business Packages
    Route::delete('business-packages/destroy', 'BusinessPackagesController@massDestroy')->name('business-packages.massDestroy');
    Route::resource('business-packages', 'BusinessPackagesController');
    // Business Payment
    Route::delete('business-payments/destroy', 'BusinessPaymentController@massDestroy')->name('business-payments.massDestroy');
    Route::resource('business-payments', 'BusinessPaymentController', ['except' => ['create', 'store', 'edit', 'update']]);
    // Business Partners
    Route::delete('business-partners/destroy', 'BusinessPartnersController@massDestroy')->name('business-partners.massDestroy');
    Route::post('business-partners/media', 'BusinessPartnersController@storeMedia')->name('business-partners.storeMedia');
    Route::post('business-partners/ckmedia', 'BusinessPartnersController@storeCKEditorImages')->name('business-partners.storeCKEditorImages');
    Route::resource('business-partners', 'BusinessPartnersController');
// Business Event Type
    Route::delete('business-event-types/destroy', 'BusinessEventTypeController@massDestroy')->name('business-event-types.massDestroy');
    Route::resource('business-event-types', 'BusinessEventTypeController');

    // Business Special Request
    Route::delete('business-special-requests/destroy', 'BusinessSpecialRequestController@massDestroy')->name('business-special-requests.massDestroy');
    Route::resource('business-special-requests', 'BusinessSpecialRequestController');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
