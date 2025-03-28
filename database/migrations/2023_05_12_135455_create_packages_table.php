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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            $table->foreignId('plan_id')->nullable()->references('id')->on('plans');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('payment_status',['Paid','Pending','Partial Paid']);
            $table->enum('status',['Active','Inactive']);
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
        Schema::dropIfExists('packages');
    }
};
