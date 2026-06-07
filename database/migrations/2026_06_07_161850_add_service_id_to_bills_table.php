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
        Schema::table('bills', function (Blueprint $table) {
            // Adds the service_id column after customer_id
            $table->unsignedBigInteger('service_id')->nullable()->after('customer_id');

            // Optional: Add a foreign key constraint if your services table exists
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            // Drop foreign key first, then the column
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
