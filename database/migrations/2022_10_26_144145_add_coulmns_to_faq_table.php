<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulmnsToFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->renameColumn('category', 'category_ar');
            $table->string('category_en')->nullable();
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            if (Schema::hasColumn('faq_questions', 'category_id')) {
            } else {
                $table->unsignedBigInteger('category_id')->nullable();
            }
            $table->renameColumn('question', 'question_ar');
            $table->renameColumn('answer', 'answer_ar');
            $table->longText('question_en')->nullable();
            $table->longText('answer_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->dropColumn('category_ar');
            $table->dropColumn('category_en');
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            $table->dropColumn('question_ar');
            $table->dropColumn('question_en');
            $table->dropColumn('answer_ar');
            $table->dropColumn('answer_en');
        });
    }
}
