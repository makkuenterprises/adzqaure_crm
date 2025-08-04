<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('admins', function (Blueprint $table) {
        // This flag marks which admin's credentials the CRM should use.
        $table->boolean('is_whatsapp_active')->default(false)->after('whatsapp_access_token')->index();
    });
}

public function down(): void
{
    Schema::table('admins', function (Blueprint $table) {
        $table->dropColumn('is_whatsapp_active');
    });
}
};
