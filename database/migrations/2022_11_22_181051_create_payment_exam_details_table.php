<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_exam_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();

            $table->string('payment_number')->nullable();
            $table->text('exam_image_url')->nullable();
            $table->text('exam_name_en')->nullable();
            $table->text('exam_name_ar')->nullable();
            $table->text('user_name_en')->nullable();
            $table->text('user_name_ar')->nullable();

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
        Schema::dropIfExists('payment_exam_details');
    }
}
