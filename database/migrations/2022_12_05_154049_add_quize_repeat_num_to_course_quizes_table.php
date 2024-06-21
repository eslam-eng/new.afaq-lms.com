<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuizeRepeatNumToCourseQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_quizes', function (Blueprint $table) {
            $table->integer('repeat_times')->nullable();
        });
        Schema::table('course_quize_scores', function (Blueprint $table) {
            $table->integer('repeat_times')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_quizes', function (Blueprint $table) {
            $table->dropColumn('repeat_times');
        });
        Schema::table('course_quize_scores', function (Blueprint $table) {
            $table->dropColumn('repeat_times');
        });
    }
}
