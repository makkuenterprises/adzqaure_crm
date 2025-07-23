<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method adds the 'gender' column to the 'customers' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Add the 'gender' column from the 'users' table.
            // We'll place it after the 'profile' column for logical grouping.
            $table->enum('gender', ['Male', 'Female', 'Other'])
                  ->nullable()
                  ->after('profile');
        });
    }

    /**
     * Reverse the migrations.
     * This method removes the 'gender' column, making the migration reversible.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Check if the column exists before trying to drop it, for safety.
            if (Schema::hasColumn('customers', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
