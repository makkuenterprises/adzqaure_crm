<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('call_bookings', function (Blueprint $table) {
            $table->id();

            // Relates directly to your customers primary key ID
            $table->unsignedBigInteger('customer_id');

            // Maps directly to $request->topic inside your live controller
            $table->string('topic', 255);

            // Maps directly to $request->scheduled_at (DateTime/Timestamp)
            $table->dateTime('scheduled_at');

            // Maps directly to your controller's validated enum values: Pending, Completed, Cancelled
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');

            // Maps directly to $request->employee_remarks
            $table->text('employee_remarks')->nullable();

            $table->timestamps();

            // Foreign key cascade constraint linking to your customers table
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_bookings');
    }
};
