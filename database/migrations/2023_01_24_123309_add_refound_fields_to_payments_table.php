<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefoundFieldsToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('refound_amount')->nullable();
            $table->string('refound_type')->nullable();
        });
        Schema::table('payment_details', function (Blueprint $table) {
            $table->string('refound_amount')->nullable();
            $table->string('refound_type')->nullable();
            $table->text('cancel_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('refound_amount');
            $table->dropColumn('refound_type');
        });
        Schema::table('payment_details', function (Blueprint $table) {
            $table->dropColumn('refound_amount');
            $table->dropColumn('refound_type');
            $table->dropColumn('cancel_reason');
        });
    }
}
