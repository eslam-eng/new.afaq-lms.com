<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('id')->on('enrolls');
            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('refundId')->nullable();
            $table->unsignedInteger('refundReference')->nullable();
            $table->double('amount');
            $table->text('comment')->nullable();
            $table->string('provider')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('refunds');
    }
}
