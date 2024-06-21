<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelatedCoulmnToCertificateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_keys', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->string('related_coulmn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_keys', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('related_coulmn');
        });
    }
}
