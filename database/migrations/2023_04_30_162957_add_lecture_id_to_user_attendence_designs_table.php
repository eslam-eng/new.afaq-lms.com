<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLectureIdToUserAttendenceDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_attendence_designs', function (Blueprint $table) {
            $table->unsignedBigInteger('lecture_id')->after('attendance_design_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_attendence_designs', function (Blueprint $table) {
            $table->dropColumn('lecture_id');
        });
    }
}
