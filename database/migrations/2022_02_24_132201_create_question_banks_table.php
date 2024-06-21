<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionBanksTable extends Migration
{
    public function up()
    {
        Schema::create('question_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('exams_title_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
