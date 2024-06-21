<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToSpecialRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_special_requests', function (Blueprint $table) {

            $table->string('number_of_attendees')->nullable()->change();
            $table->date('event_starting_date')->nullable()->change();
            $table->longText('details')->nullable()->change();
            $table->string('full_name')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('email_address')->nullable()->change();
            $table->string('accept_terms')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_special_requests', function (Blueprint $table) {
            $table->string('bank_name')->nullable(false)->change();
            $table->string('number_of_attendees')->nullable(false)->change();
            $table->date('event_starting_date')->nullable(false)->change();
            $table->longText('details')->nullable(false)->change();
            $table->string('full_name')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('email_address')->nullable(false)->change();
            $table->string('accept_terms')->nullable(false)->change();

        });
    }
}
