<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessBannersTable extends Migration
{
    public function up()
    {
        Schema::create('business_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('title_ar');
            $table->longText('description_en')->nullable();
            $table->longText('description_ar');
            $table->string('short_description_en')->nullable();
            $table->string('short_description_ar');
            $table->timestamps();
        });
    }
}
