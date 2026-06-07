<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table) {
            // Stores JSON serialized array of multiple items (SMM, SEO, etc.)
            $table->text('items')->nullable()->after('service_id');
            // Stores custom edited Terms & Conditions
            $table->text('terms')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn(['items', 'terms']);
        });
    }
};
