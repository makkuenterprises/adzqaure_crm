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
        // This creates the pivot table to link employees and roles.
        Schema::create('employee_role', function (Blueprint $table) {
            // Use foreignId for Laravel 8+ for a more concise syntax.
            // This links to the 'id' on the 'employees' table.
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            // This links to the 'id' on the 'roles' table.
            $table->foreignId('role_id')->constrained()->onDelete('cascade');

            // This sets the primary key to be a combination of both IDs,
            // which prevents an employee from having the same role twice.
            $table->primary(['employee_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_role');
    }
};
