<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCancelationPoliciesTable extends Migration
{
    public function up()
    {
        Schema::table('cancelation_policies', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_7091019')->references('id')->on('courses');
        });
    }
}
