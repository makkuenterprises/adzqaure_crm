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
    public function up()
    {
        // This will find the 'employees' table and drop the 'role' column.
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This allows you to reverse the change if needed.
        Schema::table('employees', function (Blueprint $table) {
            $table->string('role')->after('phone_alternate')->nullable(); // Add it back
        });
    }
};
