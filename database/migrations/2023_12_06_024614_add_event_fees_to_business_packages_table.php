<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventFeesToBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->boolean('digital_marketing_event')->nullable()->change();
            $table->boolean('event_fees')->default(0)->nullable()->after('digital_marketing_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->dropColumn('event_fees');
        });
    }
}
