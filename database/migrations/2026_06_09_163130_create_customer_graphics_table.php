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
        Schema::create('customer_graphics', function (Blueprint $table) {
            $table->id();

            // Relates directly to your customers primary key ID
            $table->unsignedBigInteger('customer_id');

            // The title of the shared social media creative (e.g. "Independence Day Poster")
            $table->string('title', 255);

            // Stores the cPanel storage path or absolute web URL of the design asset
            $table->string('image_path', 500);

            $table->timestamps();

            // Establish database integrity constraint (removes graphics if the customer is deleted)
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_graphics');
    }
};
