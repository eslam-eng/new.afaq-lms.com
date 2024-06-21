<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseConfigrationsTable extends Migration
{
    public function up()
    {
        Schema::create('course_configrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }
}
