<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWalletItemsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->boolean('wallet')->default(0);
            $table->string('wallet_discount')->nullable();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->boolean('wallet')->default(0);
            $table->string('wallet_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('wallet');
            $table->dropColumn('wallet_discount');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('wallet');
            $table->dropColumn('wallet_discount');
        });
    }
}
