<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceDesignKeysTable extends Migration
{
    public function up()
    {
        Schema::create('attendance_design_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->string('related_coulmn')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
