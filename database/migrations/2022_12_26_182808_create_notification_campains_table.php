<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationCampainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_campains', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->longText('message_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('message_en')->nullable();
            $table->boolean('status')->default(0)->index();
            $table->dateTime('send_at')->nullable();
            $table->unsignedBigInteger('specialty_id')->nullable();
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
        Schema::dropIfExists('notification_campains');
    }
}
