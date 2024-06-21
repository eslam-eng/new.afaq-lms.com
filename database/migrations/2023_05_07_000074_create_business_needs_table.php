<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessNeedsTable extends Migration
{
    public function up()
    {
        Schema::create('business_needs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text_en');
            $table->string('text_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->string('short_description_en')->nullable();
            $table->string('short_description_ar');
            $table->timestamps();
        });
    }
}
