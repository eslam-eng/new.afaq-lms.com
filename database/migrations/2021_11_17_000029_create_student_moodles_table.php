<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMoodlesTable extends Migration
{
    public function up()
    {
        Schema::create('student_moodles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
