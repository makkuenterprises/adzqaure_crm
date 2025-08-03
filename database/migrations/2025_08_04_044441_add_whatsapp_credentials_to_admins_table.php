<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CORRECTED: This targets your 'admins' table
        Schema::table('admins', function (Blueprint $table) {
            $table->string('whatsapp_business_account_id')->nullable()->after('password');
            $table->string('whatsapp_phone_number_id')->nullable()->after('whatsapp_business_account_id');
            $table->text('whatsapp_access_token')->nullable()->after('whatsapp_phone_number_id');
        });
    }

    public function down(): void
    {
        // CORRECTED: This correctly reverts the changes on the 'admins' table
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_business_account_id',
                'whatsapp_phone_number_id',
                'whatsapp_access_token',
            ]);
        });
    }
};
