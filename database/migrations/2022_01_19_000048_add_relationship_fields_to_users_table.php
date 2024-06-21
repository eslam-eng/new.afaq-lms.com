<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->foreign('membership_id', 'membership_fk_5819790')->references('id')->on('user_memberships');
        });
    }
}
