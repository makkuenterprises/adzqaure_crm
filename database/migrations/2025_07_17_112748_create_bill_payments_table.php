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
        Schema::create('bill_payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bill_id')->constrained('bills')->onDelete('cascade');
        $table->double('amount_received', 16, 2);
        $table->enum('payment_mode', ['Cash', 'UPI', 'Bank Transfer', 'Cheque', 'Other'])->nullable();
        $table->string('transaction_reference')->nullable(); // e.g., UPI txn ID, cheque no.
        $table->text('note')->nullable();
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
        Schema::dropIfExists('bill_payments');
    }
};
