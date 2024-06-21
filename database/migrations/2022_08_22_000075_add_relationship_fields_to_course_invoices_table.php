<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('course_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id', 'bank_fk_7192637')->references('id')->on('bank_lists');
        });
    }
}
