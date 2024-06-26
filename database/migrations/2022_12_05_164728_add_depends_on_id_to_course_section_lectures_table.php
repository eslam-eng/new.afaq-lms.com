<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDependsOnIdToCourseSectionLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_section_lectures', function (Blueprint $table) {
            $table->unsignedBigInteger('depends_on_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_section_lectures', function (Blueprint $table) {
            $table->dropColumn('depends_on_id');
        });
    }
}
