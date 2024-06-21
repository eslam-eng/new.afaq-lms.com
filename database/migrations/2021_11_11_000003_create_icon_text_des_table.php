<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconTextDesTable extends Migration
{
    public function up()
    {
        Schema::create('icon_text_des', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text_en');
            $table->string('text_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->string('link_en');
            $table->string('link_ar');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
