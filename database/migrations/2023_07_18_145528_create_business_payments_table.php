<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();


            $table->string('package_name_en')->nullable();
            $table->string('package_name_ar')->nullable();;
            $table->string('price_package_annual')->nullable();
            $table->string('package_annual_price_offers')->nullable();
            $table->string('price_package_month')->nullable();
            $table->string('package_month_price_offers')->nullable();
            $table->integer('event_number')->nullable();
            $table->integer('speakers_number')->nullable();
            $table->integer('attendance_trainees_number')->nullable();
            $table->integer('remote_trainees_number')->nullable();
            $table->boolean('electronic_registration_system')->default(0)->nullable();
            $table->boolean('e_certificate')->default(0)->nullable();
            $table->boolean('customize_event_with_host_identity')->default(0)->nullable();
            $table->string('digital_marketing_event')->nullable();
            $table->boolean('advertising_afaq_core')->default(0)->nullable();
            $table->boolean('quality_control_inquiries')->default(0)->nullable();
            $table->boolean('help_center_customer_response')->default(0)->nullable();
            $table->boolean('technical_support')->default(0)->nullable();
            $table->boolean('event_accreditation')->default(0)->nullable();
            $table->boolean('event_free_collection')->default(0)->nullable();
            $table->boolean('e_certificate_speaker')->default(0)->nullable();
            $table->boolean('two_email_trainees')->default(0)->nullable();
            $table->boolean('target_groups_mails')->default(0)->nullable();
            $table->boolean('electronic_testing_system')->default(0)->nullable();
            $table->boolean('effectiveness_rating_system')->default(0)->nullable();
            $table->boolean('discount_free_coupon')->default(0)->nullable();
            $table->boolean('event_reports')->default(0)->nullable();
            $table->boolean('attendance_absence_qr_system')->default(0)->nullable();
            $table->boolean('printable_id_card')->default(0)->nullable();
            $table->boolean('conference_workshops_attendance')->default(0)->nullable();
            $table->boolean('send_messages_event_participants')->default(0)->nullable();
            $table->boolean('event_notification_mobile')->default(0)->nullable();
            $table->boolean('fixed_advertising_banner')->default(0)->nullable();
            $table->boolean('responsible_employee_manage_event')->default(0)->nullable();


            $table->text('initial_response')->nullable();
            $table->text('status_response')->nullable();
            $table->string('payment_number')->nullable();
            $table->string('price')->nullable();
            $table->boolean('status')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_payments');
    }
}
