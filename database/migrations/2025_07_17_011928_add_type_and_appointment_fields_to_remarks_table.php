<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('remarks', function (Blueprint $table) {
            $table->string('type')->default('remark')->after('leads_manager_id');
            $table->date('appointment_date')->nullable()->after('comment');
            $table->time('appointment_time')->nullable()->after('appointment_date');
        });
    }

    public function down(): void
    {
        Schema::table('remarks', function (Blueprint $table) {
            $table->dropColumn(['type', 'appointment_date', 'appointment_time']);
        });
    }
};
