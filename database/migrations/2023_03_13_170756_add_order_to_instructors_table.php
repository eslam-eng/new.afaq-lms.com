<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *


     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->integer('order')->nullable()->after('mobile');
        });
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->integer('order')->nullable()->after('type');
        });
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->integer('order')->nullable()->after('answer_en');
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
            $table->dropColumn('order');
        });
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->dropColumn('order');
        });
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
