<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $tables = DB::select("SELECT * FROM  information_schema.tables
        // WHERE table_type='BASE TABLE'
        //       AND table_schema = 'sna'");
        // $tables = collect($tables)->pluck('TABLE_NAME')->toArray();

        $tables = [
            'answers', 'bank_invoices', 'bank_lists', 'cancelation_policy_values', 'cancelation_policies', 'carts', 'certificate_keys',
            'course_accreditation_sponsors', 'course_certificates', 'user_memberships', 'users_courses', 'zoom_meetings', 'zoom_reports',
            'enrolls', 'course_configrations', 'course_target_group', 'accreditation_sponsors', 'course_coupons', 'course_prices',
            'course_questionaire', 'course_questionaire_questions', 'course_questionaire_question_answars', 'course_questionaire_user_answars',
            'course_quize_scores', 'course_sections', 'course_section_lectures', 'course_sub_specialties', 'course_video_scores', 'exam_contents',
            'lookups', 'lookup_types', 'lookupables', 'memberships', 'membership_types', 'payment_methods', 'user_exams', 'user_memberships',
        ];

        foreach ($tables as $tab) {
            if (!Schema::hasColumn($tab, 'deleted_at')) {
                Schema::table($tab, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
