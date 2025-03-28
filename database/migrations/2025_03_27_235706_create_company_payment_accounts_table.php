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
        Schema::create('company_payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('currency_type')->nullable();
            $table->string('account_type')->nullable();
            $table->string('company_account_number')->nullable();
            $table->string('company_account_holder')->nullable();
            $table->string('company_account_ifsc')->nullable();
            $table->string('company_account_branch')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('paypal_email')->nullable();
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
        Schema::dropIfExists('company_payment_accounts');
    }
};