<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateKeysTable extends Migration
{
    public function up()
    {
        Schema::create('certificate_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
}
