<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_text')->nullable();
            $table->enum('coupon_type',['cash','percentage']);
            $table->float('coupon_amount', 15, 2)->nullable();
            $table->date('coupon_expire_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
