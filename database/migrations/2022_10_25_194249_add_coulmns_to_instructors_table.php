<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulmnsToInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->renameColumn('name', 'name_ar');
            $table->string('name_en')->nullable();
            $table->renameColumn('bio', 'bio_ar');
            $table->string('bio_en')->nullable();
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
            $table->dropColumn('name_ar');
            $table->dropColumn('name_en');
            $table->dropColumn('bio_ar');
            $table->dropColumn('bio_en');
        });
    }
}
