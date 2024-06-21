<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToSystemEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_emails', function (Blueprint $table) {
            $table->integer('name_id')->nullable();
            $table->integer('type')->default(1)->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('exam_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_emails', function (Blueprint $table) {
            $table->dropColumn('name_id');
            $table->dropColumn('type');
            $table->dropColumn('course_id');
            $table->dropColumn('exam_id');
        });
    }
}
