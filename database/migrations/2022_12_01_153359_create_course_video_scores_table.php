<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseVideoScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_video_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedBigInteger('user_id');
            $table->float('score_percentage',10,2)->default(0);
            $table->boolean('success')->default(0);
            $table->string('video_duration')->default(0);
            $table->string('show_video_duration')->default(0);
            $table->string('display_show_video_duration')->default(0);
            $table->text('show_time_ranges')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_video_scores');
    }
}
