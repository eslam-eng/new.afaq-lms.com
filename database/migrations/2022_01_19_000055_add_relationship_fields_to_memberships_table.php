<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMembershipsTable extends Migration
{
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_type_id')->nullable();
            $table->foreign('membership_type_id', 'membership_type_fk_5812819')->references('id')->on('membership_types');
        });
    }
}
