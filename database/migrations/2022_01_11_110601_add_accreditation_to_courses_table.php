<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccreditationToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('accreditation')->default(0);
            $table->integer('member_price')->nullable();
            $table->integer('non_member_price')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_ar')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('accreditation');
            $table->dropColumn('member_price');
            $table->dropColumn('non_member_price');
            $table->dropColumn('description_en');
            $table->dropColumn('description_ar');
        });
    }
}
