<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('from_user_id')->nullable();
            // $table->foreign('from_user_id')->references('id')->on('users');

            $table->bigInteger('points')->default(0);
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('point_actions');
    }
}
