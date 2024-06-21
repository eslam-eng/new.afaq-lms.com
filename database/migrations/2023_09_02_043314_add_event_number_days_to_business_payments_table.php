<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventNumberDaysToBusinessPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_payments', function (Blueprint $table) {
            $table->string('event_number_days')->nullable()->after('event_number');

            $table->string('online')->nullable()->after('event_number_days');
            $table->string('hybrid')->nullable()->after('online');
            $table->string('onsite')->nullable()->after('hybrid');


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
            $table->dropColumn('online');
            $table->dropColumn('hybrid');
            $table->dropColumn('onsite');

            $table->dropColumn('event_number_days');

        });
    }
}
