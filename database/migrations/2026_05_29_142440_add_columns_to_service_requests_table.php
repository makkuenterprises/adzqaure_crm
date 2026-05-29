<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Adds custom auto-incrementing sequential string ID column
            $table->string('service_request_id')->nullable()->unique()->after('id');
            // Adds budget column to capture the frontend currency data
            $table->decimal('budget', 12, 2)->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['service_request_id', 'budget']);
        });
    }
};
