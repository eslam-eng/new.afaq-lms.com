<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageTypeToBusinessPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_payments', function (Blueprint $table) {
            $table->enum('package_price_type' , ['monthly' ,'annual' ])->nullable()->default(null)->after('payment_number');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_payments', function (Blueprint $table) {
            $table->dropColumn('package_price_type');
        });
    }
}
