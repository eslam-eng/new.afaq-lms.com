<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_reports', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('user_email')->nullable();
            $table->dateTime('join_time')->nullable();
            $table->dateTime('leave_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('attentiveness_score')->nullable();
            $table->string('failover')->nullable();
            $table->string('status')->nullable();
            $table->string('customer_key')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->text('report_id')->nullable();
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
        Schema::dropIfExists('zoom_reports');
    }
}
