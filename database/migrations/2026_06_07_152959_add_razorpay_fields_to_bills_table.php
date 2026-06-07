<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            // Stores the short checkout URL (e.g. https://rzp.io/i/xxxx)
            $table->string('razorpay_payment_link')->nullable()->after('payment_status');
            // Stores the unique payment link ID (e.g. plink_xxxx) for reminders
            $table->string('razorpay_payment_link_id')->nullable()->after('razorpay_payment_link');
        });
    }

    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['razorpay_payment_link', 'razorpay_payment_link_id']);
        });
    }
};
