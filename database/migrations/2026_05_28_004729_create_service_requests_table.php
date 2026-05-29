<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['Pending', 'In-Progress', 'Quoted', 'Completed', 'Declined'])->default('Pending');
            $table->text('employee_remarks')->nullable(); // Employee response/reply
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->onDelete('set null'); // Linked quotation
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
};
