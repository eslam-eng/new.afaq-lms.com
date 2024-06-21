<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('editor_id');
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();;
            $table->longText('page_text')->nullable();
            $table->longText('page_text_ar')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('excerpt_ar')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
