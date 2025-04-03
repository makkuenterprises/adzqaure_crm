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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();

            // INR Payment Fields
            $table->enum('account_type_inr', ['Current', 'Saving'])->nullable();
            $table->string('company_account_number_inr')->nullable();
            $table->string('company_account_holder_inr')->nullable();
            $table->string('company_account_ifsc_inr')->nullable();
            $table->string('company_account_branch_inr')->nullable();
            $table->string('upi_payment_inr')->nullable();
            $table->string('payment_link_inr')->nullable();

            // USD Payment Fields
            $table->string('company_account_holder_usd')->nullable();
            $table->enum('payment_method_usd', ['ACH', 'Wire Transfer', 'Cheque'])->nullable();
            $table->string('ach_routing_number_usd')->nullable();
            $table->string('company_account_number_usd')->nullable();
            $table->string('bank_name_usd')->nullable();
            $table->string('beneficiary_address_usd')->nullable();

            // AUD Payment Fields
            $table->string('account_holder_aud')->nullable();
            $table->enum('payment_method_aud', ['Bank Transfer', 'Wire Transfer', 'Cheque'])->nullable();
            $table->string('company_account_number_aud')->nullable();
            $table->string('bsb_number_aud')->nullable();
            $table->string('bank_name_aud')->nullable();
            $table->string('beneficiary_address_aud')->nullable();

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_settings');
    }
};