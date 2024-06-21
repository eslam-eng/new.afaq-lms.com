<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankListsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
