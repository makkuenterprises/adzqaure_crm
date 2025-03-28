<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing)
            $table->string('company_logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_phone_alternate')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_account_type')->nullable();
            $table->string('company_account_no')->nullable();
            $table->string('company_account_holder')->nullable();
            $table->string('company_account_ifsc')->nullable();
            $table->string('company_account_branch')->nullable();
            $table->string('company_account_vpa')->nullable();
            $table->string('billing_tax_percentage')->nullable();
            $table->string('company_address_street')->nullable();
            $table->string('company_address_city')->nullable();
            $table->string('company_address_pincode')->nullable();
            $table->string('company_address_state')->nullable();
            $table->string('company_address_country')->nullable();
            $table->string('company_social_media_facebook')->nullable();
            $table->string('company_social_media_twitter')->nullable();
            $table->string('company_social_media_instagram')->nullable();
            $table->string('company_social_media_linkedin')->nullable();
            $table->string('company_social_media_youtube')->nullable();
            $table->string('company_gst_number')->nullable(); // For GST number
            $table->timestamps(); // Created at & updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_details');
    }
};