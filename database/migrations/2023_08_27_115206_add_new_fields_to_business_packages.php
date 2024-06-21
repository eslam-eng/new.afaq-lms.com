<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToBusinessPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->string('event_number')->nullable()->change();
            $table->string('event_number_days')->nullable()->change();
            $table->string('speakers_number')->nullable()->change();

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
            //
        });
    }
}
