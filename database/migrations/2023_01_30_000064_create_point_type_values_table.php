<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTypeValuesTable extends Migration
{
    public function up()
    {
        Schema::create('point_type_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('give_point')->nullable();
            $table->integer('get_point')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

        });
    }
}
