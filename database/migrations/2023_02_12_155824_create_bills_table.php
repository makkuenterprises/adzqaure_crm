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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            $table->foreignId('package_id')->nullable()->references('id')->on('packages');
            $table->foreignId('domain_hosting_id')->nullable()->references('id')->on('domain_hostings');
            $table->enum('payment_for', ['Package', 'Domain Hosting'])->nullable();
            $table->enum('payment_status',['Paid','Pending', 'Settled']);
            $table->json('items')->nullable();
            $table->double('tax',16,2)->nullable();
            $table->double('total',16,2)->nullable();
            $table->date('bill_date')->nullable();
            $table->date('due_date')->nullable();
            $table->text('bill_note')->nullable();
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
        Schema::dropIfExists('bills');
    }
};
