<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            // Identifies the conversation thread (each customer has one direct chat room)
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->enum('sender_type', ['customer', 'employee', 'admin']);
            $table->unsignedBigInteger('sender_id'); // ID of customer, employee, or admin
            $table->enum('message_type', ['text', 'image', 'voice', 'document', 'location'])->default('text');
            $table->text('message')->nullable(); // Holds text message or location "latitude,longitude"
            $table->string('file_path')->nullable(); // Uploaded file path
            $table->string('file_name')->nullable(); // Original document file name
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
