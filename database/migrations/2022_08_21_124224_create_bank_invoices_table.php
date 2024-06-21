<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('payment_method_id');
            $table->bigInteger('bank_id');
            $table->double('amount');
            $table->string('currency' , 5);
            $table->date('date');
            $table->string('bank_name');
            $table->string('bank_number');
            $table->string('invoice_image')->nullable();
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
        Schema::dropIfExists('bank_invoices');
    }
}
