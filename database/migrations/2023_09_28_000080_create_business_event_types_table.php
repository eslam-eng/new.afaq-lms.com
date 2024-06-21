<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessEventTypesTable extends Migration
{
    public function up()
    {
        Schema::create('business_event_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }
}
