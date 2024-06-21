<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::table('sub_specialties', function (Blueprint $table) {
            $table->unsignedBigInteger('specialty_id');
            $table->foreign('specialty_id', 'specialty_fk_5394247')->references('id')->on('specialties');
        });
    }
}
