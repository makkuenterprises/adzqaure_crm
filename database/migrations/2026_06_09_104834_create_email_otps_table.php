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
        Schema::create('email_otps', function (Blueprint $table) {
            $table->id();

            // Stores the recipient email, enforced as unique to prevent duplicate codes per user
            $table->string('email')->unique();

            // Stores the hashed/plain text verification PIN
            $table->string('otp');

            // Records the generation timestamp to evaluate code expiration limits (15 mins)
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_otps');
    }
};
