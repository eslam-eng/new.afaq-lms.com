<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                "title" => "user_management_access",
            ],
            [
                "title" => "permission_create",
            ],
            [
                "title" => "permission_edit",
            ],
            [
                "title" => "permission_show",
            ],
            [
                "title" => "permission_delete",
            ],
            [
                "title" => "permission_access",
            ],
            [
                "title" => "role_create",
            ],
            [
                "title" => "role_edit",
            ],
            [
                "title" => "role_show",
            ],
            [
                "title" => "role_delete",
            ],
            [
                "title" => "role_access",
            ],
            [
                "title" => "user_create",
            ],
            [
                "title" => "user_edit",
            ],
            [
                "title" => "user_show",
            ],
            [
                "title" => "user_delete",
            ],
            [
                "title" => "user_access",
            ],
            [
                "title" => "user_alert_create",
            ],
            [
                "title" => "user_alert_show",
            ],
            [
                "title" => "user_alert_delete",
            ],
            [
                "title" => "user_alert_access",
            ],
            [
                "title" => "faq_management_access",
            ],
            [
                "title" => "faq_category_create",
            ],
            [
                "title" => "faq_category_edit",
            ],
            [
                "title" => "faq_category_show",
            ],
            [
                "title" => "faq_category_delete",
            ],
            [
                "title" => "faq_category_access",
            ],
            [
                "title" => "faq_question_create",
            ],
            [
                "title" => "faq_question_edit",
            ],
            [
                "title" => "faq_question_show",
            ],
            [
                "title" => "faq_question_delete",
            ],
            [
                "title" => "faq_question_access",
            ],
            [
                "title" => "payment_show",
            ],
            [
                "title" => "payment_access",
            ],
            [
                "title" => "pay_now_access",
            ],
            [
                "title" => "profile_password_edit",
            ],
            [
                "title" => "BioHealth_Student",
            ],
            [
                "title" => "Egyptology_Student",
            ],
            [
                "title" => "student_management_access",
            ],
            [
                "title" => "binding_student_access",
            ],
            [
                "title" => "unchecked_student_access",
            ],
            [
                "title" => "withdrawal_student_access",
            ],
            [
                "title" => "approved_student_access",
            ],
            [
                "title" => "disapproved_student_access",
            ],
            [
                "title" => "Unverified_student_access",
            ],
            [
                "title" => "Send_Email_Unpaid",
            ],
            [
                "title" => "user_verify",
            ],
            [
                "title" => "lecture_create",
            ],
            [
                "title" => "lecture_edit",
            ],
            [
                "title" => "lecture_show",
            ],
            [
                "title" => "lecture_delete",
            ],
            [
                "title" => "lecture_access",
            ],
            [
                "title" => "visitor_management_access",
            ],
            [
                "title" => "system_email_create",
            ],
            [
                "title" => "system_email_edit",
            ],
            [
                "title" => "system_email_show",
            ],
            [
                "title" => "system_email_delete",
            ],
            [
                "title" => "system_email_access",
            ],
            [
                "title" => "user_log_create",
            ],
            [
                "title" => "user_log_access",
            ],
            [
                "title" => "user_log_edit",
            ],
            [
                "title" => "user_log_show",
            ],
            [
                "title" => "user_log_delete",
            ],
            [
                "title" => "payment_create",
            ],
            [
                "title" => "website_access",
            ],
            [
                "title" => "home_page_slider_create",
            ],
            [
                "title" => "home_page_slider_edit",
            ],
            [
                "title" => "home_page_slider_show",
            ],
            [
                "title" => "home_page_slider_delete",
            ],
            [
                "title" => "home_page_slider_access",
            ],
            [
                "title" => "snippet_create",
            ],
            [
                "title" => "snippet_edit",
            ],
            [
                "title" => "snippet_show",
            ],
            [
                "title" => "snippet_delete",
            ],
            [
                "title" => "snippet_access",
            ],
            [
                "title" => "enquiry_access",
            ],
            [
                "title" => "enquiry_delete",
            ],
            [
                "title" => "enquiry_show",
            ],
            [
                "title" => "coming_soon_access",
            ],
            [
                "title" => "coming_soon_delete",
            ],
            [
                "title" => "coming_soon_show",
            ],
            [
                "title" => "coming_soon_edit",
            ],
            [
                "title" => "coming_soon_create",
            ],
            [
                "title" => "founder_access",
            ],
            [
                "title" => "founder_delete",
            ],
            [
                "title" => "founder_show",
            ],
            [
                "title" => "founder_edit",
            ],
            [
                "title" => "founder_create",
            ],
            [
                "title" => "content_page_access",
            ],
            [
                "title" => "content_page_create",
            ],
            [
                "title" => "content_page_edit",
            ],
            [
                "title" => "content_page_show",
            ],
            [
                "title" => "content_page_delete",
            ],
            [
                "title" => "blog_create",
            ],
            [
                "title" => "blog_edit",
            ],
            [
                "title" => "blog_show",
            ],
            [
                "title" => "blog_delete",
            ],
            [
                "title" => "blog_access",
            ],
            [
                "title" => "content_management_access",
            ],
            [
                "title" => "content_category_create",
            ],
            [
                "title" => "content_category_edit",
            ],
            [
                "title" => "content_category_show",
            ],
            [
                "title" => "content_category_delete",
            ],
            [
                "title" => "content_category_access",
            ],
            [
                "title" => "content_tag_create",
            ],
            [
                "title" => "content_tag_edit",
            ],
            [
                "title" => "content_tag_show",
            ],
            [
                "title" => "content_tag_delete",
            ],
            [
                "title" => "content_tag_access",
            ],
            [
                "title" => "blogscomment_show",
            ],
            [
                "title" => "blogscomment_edit",
            ],
            [
                "title" => "blogscomment_delete",
            ],
            [
                "title" => "blogscomment_access",
            ],
            [
                "title" => "BioHealth_Student",
            ],
            [
                "title" => "Egyptology_Student",
            ],
            [
                "title" => "job_create",
            ],
            [
                "title" => "job_edit",
            ],
            [
                "title" => "job_show",
            ],
            [
                "title" => "job_delete",
            ],
            [
                "title" => "job_access",
            ],
            [
                "title" => "job_application_create",
            ],
            [
                "title" => "job_application_edit",
            ],
            [
                "title" => "job_application_show",
            ],
            [
                "title" => "job_application_delete",
            ],
            [
                "title" => "job_application_access",
            ],
            [
                "title" => "home_page_access",
            ],
            [
                "title" => "slider_create",
            ],
            [
                "title" => "slider_edit",
            ],
            [
                "title" => "slider_show",
            ],
            [
                "title" => "slider_delete",
            ],
            [
                "title" => "slider_access",
            ],
            [
                "title" => "slider_card_create",
            ],
            [
                "title" => "slider_card_edit",
            ],
            [
                "title" => "slider_card_show",
            ],
            [
                "title" => "slider_card_delete",
            ],
            [
                "title" => "slider_card_access",
            ],
            [
                "title" => "icon_text_create",
            ],
            [
                "title" => "icon_text_edit",
            ],
            [
                "title" => "icon_text_show",
            ],
            [
                "title" => "icon_text_delete",
            ],
            [
                "title" => "icon_text_access",
            ],
            [
                "title" => "partner_create",
            ],
            [
                "title" => "partner_edit",
            ],
            [
                "title" => "partner_show",
            ],
            [
                "title" => "partner_delete",
            ],
            [
                "title" => "partner_access",
            ],
            [
                "title" => "icon_text_de_create",
            ],
            [
                "title" => "icon_text_de_edit",
            ],
            [
                "title" => "icon_text_de_show",
            ],
            [
                "title" => "icon_text_de_delete",
            ],
            [
                "title" => "icon_text_de_access",
            ],
            [
                "title" => "editor_create",
            ],
            [
                "title" => "editor_edit",
            ],
            [
                "title" => "editor_show",
            ],
            [
                "title" => "editor_delete",
            ],
            [
                "title" => "editor_access",
            ],
            [
                "title" => "courses_section_access",
            ],
            [
                "title" => "instructor_create",
            ],
            [
                "title" => "instructor_edit",
            ],
            [
                "title" => "instructor_show",
            ],
            [
                "title" => "instructor_delete",
            ],
            [
                "title" => "instructor_access",
            ],
            [
                "title" => "course_create",
            ],
            [
                "title" => "course_edit",
            ],
            [
                "title" => "course_show",
            ],
            [
                "title" => "course_delete",
            ],
            [
                "title" => "course_access",
            ],
            [
                "title" => "student_moodle_create",
            ],
            [
                "title" => "student_moodle_edit",
            ],
            [
                "title" => "student_moodle_show",
            ],
            [
                "title" => "student_moodle_delete",
            ],
            [
                "title" => "student_moodle_access",
            ],
            [
                "title" => "course_category_create",
            ],
            [
                "title" => "course_category_edit",
            ],
            [
                "title" => "course_category_show",
            ],
            [
                "title" => "course_category_delete",
            ],
            [
                "title" => "course_category_access",
            ],
            [
                "title" => "student_speciality_access",
            ],
            [
                "title" => "specialty_create",
            ],
            [
                "title" => "specialty_edit",
            ],
            [
                "title" => "specialty_show",
            ],
            [
                "title" => "specialty_delete",
            ],
            [
                "title" => "specialty_access",
            ],
            [
                "title" => "sub_specialty_create",
            ],
            [
                "title" => "sub_specialty_edit",
            ],
            [
                "title" => "sub_specialty_show",
            ],
            [
                "title" => "sub_specialty_delete",
            ],
            [
                "title" => "sub_specialty_access",
            ],
            [
                'title' => 'cart_create',
            ],
            [
                'title' => 'cart_edit',
            ],
            [
                'title' => 'cart_show',
            ],
            [
                'title' => 'cart_delete',
            ],
            [
                'title' => 'cart_access',
            ],
            [
                'title' => 'coupon_code_create',
            ],
            [
                'title' => 'coupon_code_edit',
            ],
            [
                'title' => 'coupon_code_show',
            ],
            [
                'title' => 'coupon_code_delete',
            ],
            [

                'title' => 'coupon_code_access',
            ],

            [

                'title' => 'payment_method_create',
            ],
            [

                'title' => 'payment_method_edit',
            ],
            [

                'title' => 'payment_method_show',
            ],
            [

                'title' => 'payment_method_delete',
            ],
            [

                'title' => 'payment_method_access',
            ],
            [
                'title' => 'accreditation_sponsor_create',
            ],
            [

                'title' => 'accreditation_sponsor_edit',
            ],
            [

                'title' => 'accreditation_sponsor_show',
            ],
            [

                'title' => 'accreditation_sponsor_delete',
            ],
            [

                'title' => 'accreditation_sponsor_access',
            ],
            [

                'title' => 'university_create',
            ],
            [

                'title' => 'university_edit',
            ],
            [

                'title' => 'university_show',
            ],
            [

                'title' => 'university_delete',
            ],
            [

                'title' => 'university_access',
            ],
            [

                'title' => 'hospital_create',
            ],
            [

                'title' => 'hospital_edit',
            ],
            [

                'title' => 'hospital_show',
            ],
            [

                'title' => 'hospital_delete',
            ],
            [

                'title' => 'hospital_access',
            ],
            [

                'title' => 'membership_type_create',
            ],
            [

                'title' => 'membership_type_edit',
            ],
            [

                'title' => 'membership_type_show',
            ],
            [

                'title' => 'membership_type_delete',
            ],
            [

                'title' => 'membership_type_access',
            ],
            [

                'title' => 'membership_create',
            ],
            [

                'title' => 'membership_edit',
            ],
            [

                'title' => 'membership_show',
            ],
            [

                'title' => 'membership_delete',
            ],
            [

                'title' => 'membership_access',
            ],
            [

                'title' => 'user_membership_create',
            ],
            [

                'title' => 'user_membership_edit',
            ],
            [

                'title' => 'user_membership_show',
            ],
            [

                'title' => 'user_membership_delete',
            ],
            [

                'title' => 'user_membership_access',
            ],
            [

                'title' => 'newsletter_create',
            ],
            [

                'title' => 'newsletter_edit',
            ],
            [

                'title' => 'newsletter_show',
            ],
            [

                'title' => 'newsletter_delete',
            ],
            [

                'title' => 'newsletter_access',
            ],
            [

                'title' => 'exams_section_access',
            ],
            [

                'title' => 'certificat_create',
            ],
            [

                'title' => 'certificat_edit',
            ],
            [

                'title' => 'certificat_show',
            ],
            [

                'title' => 'certificat_delete',
            ],
            [

                'title' => 'certificat_access',
            ],
            [
                'title' => 'exams_title_create',
            ],
            [

                'title' => 'exams_title_edit',
            ],
            [

                'title' => 'exams_title_show',
            ],
            [

                'title' => 'exams_title_delete',
            ],
            [

                'title' => 'exams_title_access',
            ],
            [

                'title' => 'question_bank_create',
            ],
            [

                'title' => 'question_bank_edit',
            ],
            [

                'title' => 'question_bank_show',
            ],
            [
                'title' => 'question_bank_delete',
            ],
            [

                'title' => 'question_bank_access',
            ],

            [

                'title' => 'exam_create',
            ],
            [

                'title' => 'exam_edit',
            ],
            [

                'title' => 'exam_show',
            ],
            [

                'title' => 'exam_delete',
            ],
            [

                'title' => 'exam_access',
            ],
            [

                'title' => 'certificate_key_create',
            ],
            [

                'title' => 'certificate_key_edit',
            ],
            [

                'title' => 'certificate_key_show',
            ],
            [

                'title' => 'certificate_key_delete',
            ],
            [

                'title' => 'certificate_key_access',
            ],
            [

                'title' => 'exam_create',
            ],
            [

                'title' => 'exam_edit',
            ],
            [

                'title' => 'exam_show',
            ],
            [

                'title' => 'exam_delete',
            ],
            [

                'title' => 'exam_access',
            ],
            [

                'title' => 'course_price_create',
            ],
            [

                'title' => 'course_price_edit',
            ],
            [

                'title' => 'course_price_show',
            ],
            [

                'title' => 'course_price_delete',
            ],
            [

                'title' => 'course_price_access',
            ],
            [

                'title' => 'cancelation_policy_create',
            ],
            [

                'title' => 'cancelation_policy_edit',
            ],
            [

                'title' => 'cancelation_policy_show',
            ],
            [



                'title' => 'cancelation_policy_delete',
            ],
            [

                'title' => 'cancelation_policy_access',
            ],
            [

                'title' => 'purchase_access',
            ],
            [

                'title' => 'reservation_show',
            ],
            [

                'title' => 'reservation_access',
            ],
            [

                'title' => 'enrollment_show',
            ],

            [

                'title' => 'enrollment_access',
            ],
            [

                'title' => 'zoom_meeting_create',
            ],
            [

                'title' => 'zoom_meeting_edit',
            ],
            [

                'title' => 'zoom_meeting_show',
            ],
            [

                'title' => 'zoom_meeting_delete',
            ],
            [

                'title' => 'zoom_meeting_access',
            ],
            [

                'title' => 'bank_list_create',
            ],
            [

                'title' => 'bank_list_edit',
            ],
            [

                'title' => 'bank_list_show',
            ],
            [

                'title' => 'bank_list_delete',
            ],
            [

                'title' => 'bank_list_access',
            ],
            [

                'title' => 'course_invoice_create',
            ],
            [

                'title' => 'course_invoice_edit',
            ],
            [

                'title' => 'course_invoice_show',
            ],
            [

                'title' => 'course_invoice_delete',
            ],
            [

                'title' => 'course_invoice_access',
            ],
            [

                'title' => 'course_configration_create',
            ],
            [

                'title' => 'course_configration_edit',
            ],
            [

                'title' => 'course_configration_show',
            ],
            [

                'title' => 'course_configration_delete',
            ],
            [

                'title' => 'course_configration_access',
            ],
            [

                'title' => 'sna_report_access',
            ],


            [

                'title' => 'courses_user_show',
            ],

            [

                'title' => 'courses_user_access',
            ],

            [

                'title' => 'user_course_show',
            ],
            [

                'title' => 'user_course_access',
            ],


            [

                'title' => 'coupon_code_course_show',
            ],

            [

                'title' => 'coupon_code_course_access',
            ],
            [

                'title' => 'course_quize_create',
            ],
            [

                'title' => 'course_quize_edit',
            ],
            [

                'title' => 'course_quize_show',
            ],
            [

                'title' => 'course_quize_delete',
            ],
            [

                'title' => 'course_quize_access',
            ],
            [

                'title' => 'afaq_access',
            ],
            [

                'title' => 'testimonial_create',
            ],
            [

                'title' => 'testimonial_edit',
            ],
            [

                'title' => 'testimonial_show',
            ],
            [

                'title' => 'testimonial_delete',
            ],
            [

                'title' => 'testimonial_access',
            ],
            [
                'title' => 'un_paied_invoice_access',
            ],
            [

                'title' => 'user_notification_create',
            ],
            [

                'title' => 'user_notification_edit',
            ],
            [

                'title' => 'user_notification_show',
            ],
            [

                'title' => 'user_notification_delete',
            ],
            [

                'title' => 'user_notification_access',
            ],
            [

                'title' => 'notification_campain_create',
            ],
            [

                'title' => 'notification_campain_edit',
            ],
            [

                'title' => 'notification_campain_show',
            ],
            [

                'title' => 'notification_campain_delete',
            ],
            [

                'title' => 'notification_campain_access',
            ],
            [

                'title' => 'cancel_request_show',
            ],
            [

                'title' => 'cancel_request_delete',
            ],
            [

                'title' => 'cancel_request_access',
            ],
            [

                'title' => 'wallet_create',
            ],
            [

                'title' => 'wallet_edit',
            ],
            [

                'title' => 'wallet_show',
            ],
            [

                'title' => 'wallet_delete',
            ],
            [

                'title' => 'wallet_access',
            ],
            [

                'title' => 'point_access',
            ],
            [

                'title' => 'point_type_create',
            ],
            [

                'title' => 'point_type_edit',
            ],
            [

                'title' => 'point_type_show',
            ],
            [

                'title' => 'point_type_delete',
            ],
            [

                'title' => 'point_type_access',
            ],
            [

                'title' => 'point_type_value_create',
            ],
            [

                'title' => 'point_type_value_edit',
            ],
            [

                'title' => 'point_type_value_show',
            ],
            [

                'title' => 'point_type_value_delete',
            ],
            [

                'title' => 'point_type_value_access',
            ],
            [

                'title' => 'point_data_show',
            ],
            [

                'title' => 'point_data_delete',
            ],
            [

                'title' => 'point_data_access',
            ],
            [
                'title' => 'point_action_delete',
            ],
            [
               'title' => 'point_action_access',
            ],
            [

                'title' => 'attendance_course_event_access',
            ],
            [

                'title' => 'attendance_design_create',
            ],
            [

                'title' => 'attendance_design_edit',
            ],
            [

                'title' => 'attendance_design_show',
            ],
            [

                'title' => 'attendance_design_delete',
            ],
            [

                'title' => 'attendance_design_access',
            ],
            [

                'title' => 'attendance_design_key_create',
            ],
            [

                'title' => 'attendance_design_key_edit',
            ],
            [

                'title' => 'attendance_design_key_show',
            ],
            [

                'title' => 'attendance_design_key_delete',
            ],
            [

                'title' => 'attendance_design_key_access',
            ],
            [

                'title' => 'technical_support_ticket_access',
            ],
            [

                'title' => 'ticket_create',
            ],
            [

                'title' => 'ticket_edit',
            ],
            [

                'title' => 'ticket_show',
            ],
            [

                'title' => 'ticket_delete',
            ],
            [

                'title' => 'ticket_access',
            ],
            [

                'title' => 'ticket_category_create',
            ],
            [

                'title' => 'ticket_category_edit',
            ],
            [

                'title' => 'ticket_category_show',
            ],
            [

                'title' => 'ticket_category_delete',
            ],
            [

                'title' => 'ticket_category_access',
            ],
            [

                'title' => 'ticket_comment_create',
            ],
            [
                'title' => 'ticket_comment_edit',
            ],
            [
                'title' => 'ticket_comment_show',
            ],
            [
                'title' => 'ticket_comment_delete',
            ],
            [
                'title' => 'ticket_comment_access',
            ],
            //These Permission for admin can creat User attend from admin
            [
                'title' => 'user_attendance_create',
            ],
            [
                'title' => 'user_attendance_edit',
            ],
            [
                'title' => 'user_attendance_show',
            ],
            [
                'title' => 'user_attendance_delete',
            ],
            [
                'title' => 'user_attendance_access',
            ],
            //to this
            [
                'title' => 'can_attend',
            ],
            //AFAQ Business
            [

                'title' => 'afaq_business_access',
            ],
            [

                'title' => 'business_banner_create',
            ],
            [

                'title' => 'business_banner_edit',
            ],
            [

                'title' => 'business_banner_show',
            ],
            [

                'title' => 'business_banner_delete',
            ],
            [

                'title' => 'business_banner_access',
            ],
            [

                'title' => 'business_need_create',
            ],
            [

                'title' => 'business_need_edit',
            ],
            [

                'title' => 'business_need_show',
            ],
            [

                'title' => 'business_need_delete',
            ],
            [

                'title' => 'business_need_access',
            ],
            [

                'title' => 'business_medical_type_create',
            ],
            [

                'title' => 'business_medical_type_edit',
            ],
            [

                'title' => 'business_medical_type_show',
            ],
            [

                'title' => 'business_medical_type_delete',
            ],
            [

                'title' => 'business_medical_type_access',
            ],
            [

                'title' => 'business_feature_create',
            ],
            [

                'title' => 'business_feature_edit',
            ],
            [

                'title' => 'business_feature_show',
            ],
            [

                'title' => 'business_feature_delete',
            ],
            [

                'title' => 'business_feature_access',
            ],
            [

                'title' => 'business_package_create',
            ],
            [

                'title' => 'business_package_edit',
            ],
            [

                'title' => 'business_package_show',
            ],
            [

                'title' => 'business_package_delete',
            ],
            [

                'title' => 'business_package_access',
            ],
            [

                'title' => 'business_payment_show',
            ],
            [

                'title' => 'business_payment_delete',
            ],
            [

                'title' => 'business_payment_access',
            ],
            [

                'title' => 'business_partner_create',
            ],
            [

                'title' => 'business_partner_edit',
            ],
            [

                'title' => 'business_partner_show',
            ],
            [

                'title' => 'business_partner_delete',
            ],
            [

                'title' => 'business_partner_access',
            ],
            [

                'title' => 'business_event_type_create',
            ],
            [

                'title' => 'business_event_type_edit',
            ],
            [

                'title' => 'business_event_type_show',
            ],
            [

                'title' => 'business_event_type_delete',
            ],
            [

                'title' => 'business_event_type_access',
            ],
            [

                'title' => 'business_special_request_create',
            ],
            [

                'title' => 'business_special_request_edit',
            ],
            [

                'title' => 'business_special_request_show',
            ],
            [

                'title' => 'business_special_request_delete',
            ],
            [

                'title' => 'business_special_request_access',
            ],
        ];
        Permission::insertOrIgnore($permissions);
    }
}


