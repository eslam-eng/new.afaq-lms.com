<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('course_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice');
            $table->integer('payment_method')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->string('currency')->nullable();
            $table->date('date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->timestamps();
        });
    }
}
