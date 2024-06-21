<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->integer('specialty_id')->after('password')->nullable();

            $table->string('job_title')->after('mobile')->nullable();
            $table->string('workplace')->after('job_title')->nullable();
            $table->string('twitter_account')->after('workplace')->nullable();
            $table->string('recent_work')->after('twitter_account')->nullable();
            $table->integer('status')->default(0)->after('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn('specialty_id');
            $table->dropColumn('job_title');
            $table->dropColumn('workplace');
            $table->dropColumn('twitter_account');
            $table->dropColumn('recent_work');
            $table->dropColumn('status');
        });
    }
}
