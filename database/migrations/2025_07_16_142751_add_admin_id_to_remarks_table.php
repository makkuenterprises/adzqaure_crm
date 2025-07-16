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
        Schema::table('remarks', function (Blueprint $table) {
            // Add the new column after 'leads_manager_id' for neatness.
            // It can be nullable() if some remarks might be system-generated without a user.
            // Assumes your admins table is named 'admins'. Change if needed.
            $table->foreignId('admin_id')
                  ->nullable()
                  ->after('leads_manager_id')
                  ->constrained('admins') // This sets up the foreign key constraint
                  ->onDelete('set null'); // Optional: If an admin is deleted, set remark's admin_id to NULL instead of deleting the remark.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remarks', function (Blueprint $table) {
            // Important to drop the foreign key before the column
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};
