<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleEnToUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->renameColumn('title', 'title_ar');
            $table->renameColumn('message', 'message_ar');
            $table->string('title_en')->nullable();
            $table->longText('message_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropColumn('title_ar');
            $table->dropColumn('title_en');
            $table->dropColumn('message_ar');
            $table->dropColumn('message_en');
        });
    }
}
