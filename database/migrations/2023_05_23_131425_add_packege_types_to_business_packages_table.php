<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackegeTypesToBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->string('event_number_days')->nullable();
            $table->boolean('online')->default(0)->nullable();
            $table->boolean('hybrid')->default(0)->nullable();
            $table->boolean('onsite')->default(0)->nullable();
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
            $table->dropColumn('event_number_days');
            $table->dropColumn('online');
            $table->dropColumn('hybrid');
            $table->dropColumn('onsite');
        });
    }
}
