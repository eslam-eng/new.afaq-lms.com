<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_track_id')->nullable();
            $table->unsignedBigInteger('course_classification_id')->nullable();
            $table->unsignedBigInteger('course_availability_id')->nullable();
            $table->unsignedBigInteger('course_place_id')->nullable();
            $table->float('lat',10,2)->nullable();
            $table->float('lng',10,2)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('accredit_hours')->nullable();
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
            $table->dropColumn('course_track_id');
            $table->dropColumn('course_classification_id');
            $table->dropColumn('course_availability_id');
            $table->dropColumn('course_place_id');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
            $table->dropColumn('accredit_hours');
        });
    }
}
