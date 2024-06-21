<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFeaturesTable extends Migration
{
    public function up()
    {
        Schema::create('business_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text_en');
            $table->string('text_ar');
            $table->timestamps();
        });
    }
}
