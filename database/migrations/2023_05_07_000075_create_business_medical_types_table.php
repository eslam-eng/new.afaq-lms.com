<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMedicalTypesTable extends Migration
{
    public function up()
    {
        Schema::create('business_medical_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('medical_header_en')->nullable();
            $table->string('medical_header_ar')->nullable();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('short_description_en')->nullable();
            $table->string('short_description_ar');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
