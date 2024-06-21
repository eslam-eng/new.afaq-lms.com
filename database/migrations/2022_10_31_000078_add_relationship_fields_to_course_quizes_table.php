<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseQuizesTable extends Migration
{
    public function up()
    {
        Schema::table('course_quizes', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_7551742')->references('id')->on('courses');
            $table->unsignedBigInteger('exam_title_id')->nullable();
            $table->foreign('exam_title_id', 'exam_title_fk_7551743')->references('id')->on('exams_titles');
        });
    }
}
