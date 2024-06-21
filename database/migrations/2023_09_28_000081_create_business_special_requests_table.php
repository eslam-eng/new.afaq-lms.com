<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessSpecialRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('business_special_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_type_id')->nullable();
            $table->string('number_of_attendees');
            $table->date('event_starting_date');
            $table->longText('details');
            $table->string('full_name');
            $table->string('employer')->nullable();
            $table->string('job_title')->nullable();
            $table->string('phone_number');
            $table->string('email_address');
            $table->string('accept_terms');
            $table->timestamps();
        });
    }
}
