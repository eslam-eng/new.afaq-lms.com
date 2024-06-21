<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('full_name_ar')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('degree')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('specialty_id')->nullable();
            $table->unsignedBigInteger('sub_specialty_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
