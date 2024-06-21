<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminInvoiceNoteToBankInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_invoices', function (Blueprint $table) {
            $table->string('admin_invoice_note')->after('bank_number')->nullable();
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
            $table->dropColumn('admin_invoice_note');
        });
    }
}
