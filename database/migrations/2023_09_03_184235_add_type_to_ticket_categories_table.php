<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToTicketCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_categories', function (Blueprint $table) {
            $table->enum('type', ['AFAQ', 'Business'])->after('status')->nullable()->default('AFAQ');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('type', ['AFAQ', 'Business'])->nullable()->after('image')->default('AFAQ');
        });
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->enum('type', ['AFAQ', 'Business'])->nullable()->after('comment_type')->default('AFAQ');
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
            $table->dropColumn('type');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
