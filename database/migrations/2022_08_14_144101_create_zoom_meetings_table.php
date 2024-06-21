<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('meeting_id');
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->text('all_data')->nullable();
            $table->string('topic')->nullable();
            $table->datetime('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->longText('agenda')->nullable();
            $table->boolean('host_video')->default(0)->nullable();
            $table->boolean('participant_video')->default(0)->nullable();
            $table->string('password')->nullable();
            $table->boolean('default_password')->default(0);
            $table->string('type')->nullable();
            $table->string('audio')->nullable();
            $table->string('auto_recording')->nullable();
            $table->string('alternative_hosts')->nullable();
            $table->boolean('mute_upon_entry')->default(0)->nullable();
            $table->boolean('watermark')->default(0)->nullable();
            $table->boolean('waiting_room')->default(0)->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('zoom_meetings');
    }
}
