<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTextNameFromBusinessNeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_needs', function (Blueprint $table) {
            $table->dropColumn(['text_en', 'text_ar','description_en','description_ar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_needs', function (Blueprint $table) {
            //
        });
    }
}
