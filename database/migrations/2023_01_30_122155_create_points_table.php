<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('points')->default(0);
            $table->string('invite_code')->nullable();
            $table->boolean('use_code')->default(0);
            $table->string('used_code')->nullable();
            $table->string('currency')->default('SAR');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
