<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('moodle')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('image_title_en')->nullable();
            $table->string('image_title_ar')->nullable();
            $table->longText('introduction_to_course_en')->nullable();
            $table->longText('introduction_to_course_ar')->nullable();
            $table->integer('certificate_price')->nullable();
            $table->integer('accreditation_number')->nullable();
            $table->date('start_register_date')->nullable();
            $table->date('end_register_date')->nullable();
            $table->string('course_place')->nullable();
            $table->string('training_type')->nullable();

            $table->integer('lecture_hours')->nullable();
            $table->integer('seating_number')->nullable();
            $table->boolean('show_in_homepage')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
