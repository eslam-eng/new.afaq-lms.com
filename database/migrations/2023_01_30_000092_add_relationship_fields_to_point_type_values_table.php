<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointTypeValuesTable extends Migration
{
    public function up()
    {
        Schema::table('point_type_values', function (Blueprint $table) {
            $table->unsignedBigInteger('point_type_id')->nullable()->unique();
            $table->foreign('point_type_id', 'point_type_fk_7950620')->references('id')->on('point_types');
        });
    }
}
