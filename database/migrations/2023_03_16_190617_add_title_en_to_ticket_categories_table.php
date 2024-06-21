<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleEnToTicketCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_categories', function (Blueprint $table) {
            $table->renameColumn('title', 'title_ar');
            $table->string('title_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *

     * @return void
     */
    public function down()
    {
        Schema::table('ticket_categories', function (Blueprint $table) {
            $table->dropColumn('title_ar');
            $table->dropColumn('title_en');
        });
    }
}
