<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->enum('type', ['AFAQ', 'Business'])->nullable()->default('AFAQ');
        });
//        Schema::table('blogs', function (Blueprint $table) {
//            $table->enum('type', ['AFAQ', 'Business'])->nullable()->after('excerpt')->default('AFAQ');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('type');
        });
//        Schema::table('blogs', function (Blueprint $table) {
//            $table->dropColumn('type');
//        });
    }
}
