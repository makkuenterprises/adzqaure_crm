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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // Link directly to your customers database table
            $table->unsignedBigInteger('customer_id');

            // Distinguish who sent the message ('customer' or 'employee')
            $table->enum('sender_type', ['customer', 'employee'])->default('customer');

            // Message text payload (Nullable if the customer is only sending a file)
            $table->text('message')->nullable();

            // Advanced Chat Type system
            $table->enum('type', ['text', 'image', 'voice'])->default('text');

            // Stores the cPanel secure URL pointing to the image or audio file
            $table->string('media_url', 500)->nullable();

            // Stores the total recording time in seconds
            $table->integer('voice_duration')->nullable();

            $table->timestamps();

            // Establish database integrity constraint
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
