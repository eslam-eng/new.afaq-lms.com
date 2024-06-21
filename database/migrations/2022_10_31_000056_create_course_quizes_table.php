<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQuizesTable extends Migration
{
    public function up()
    {
        Schema::create('course_quizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('title_ar');
            $table->longText('description_en')->nullable();
            $table->longText('description_ar');
            $table->longText('tips_guidelines')->nullable();
            $table->float('success_percentage', 6, 2);
            $table->string('status');
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
