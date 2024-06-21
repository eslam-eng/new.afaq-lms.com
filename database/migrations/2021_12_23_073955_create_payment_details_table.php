<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();

            $table->string('payment_number')->nullable();
            $table->text('course_image_url')->nullable();
            $table->text('course_name_en')->nullable();
            $table->text('course_name_ar')->nullable();
            $table->text('user_name_en')->nullable();
            $table->text('user_name_ar')->nullable();
            $table->text('instructor_name_en')->nullable();
            $table->text('instructor_name_ar')->nullable();

            $table->string('price')->nullable();
            $table->string('offer')->nullable();
            $table->string('final_price')->nullable();

            $table->boolean('status')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
