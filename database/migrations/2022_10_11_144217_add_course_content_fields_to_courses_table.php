<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseContentFieldsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->mediumText('requirements_en')->nullable()->after('description_ar');
            $table->mediumText('requirements_ar')->nullable()->after('description_ar');
            $table->string('evaluation')->nullable()->after('description_ar');
            $table->string('full_training_evaluation')->nullable()->after('description_ar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('requirements_en');
            $table->dropColumn('requirements_ar');
            $table->dropColumn('evaluation');
            $table->dropColumn('full_training_evaluation');
        });
    }
}
