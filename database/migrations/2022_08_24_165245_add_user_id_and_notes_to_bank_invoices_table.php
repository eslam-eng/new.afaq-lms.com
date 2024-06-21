<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndNotesToBankInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_invoices', function (Blueprint $table) {
            //
            $table->string('user_id');
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_invoices', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('notes');
        });
    }
}
