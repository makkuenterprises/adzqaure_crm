<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->double('discount_percentage', 8, 2)->nullable()->after('items');
            $table->double('discount_amount', 16, 2)->nullable()->after('discount_percentage');
            $table->double('received_amount', 16, 2)->default(0)->after('total');
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['discount_percentage', 'discount_amount', 'received_amount']);
        });
    }
};
