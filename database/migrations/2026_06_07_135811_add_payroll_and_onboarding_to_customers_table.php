<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Adds Onboarding date column
            $table->date('onboarding_date')->nullable()->after('country');
            // Stores a serialized JSON string array of the checked services
            $table->text('interested_services')->nullable()->after('onboarding_date');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['onboarding_date', 'interested_services']);
        });
    }
};
