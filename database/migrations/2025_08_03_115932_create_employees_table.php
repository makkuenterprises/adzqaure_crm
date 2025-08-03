<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create the 'employees' table
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->string('employee_id')->unique()->nullable();
            $table->string('name');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('email_official')->nullable();
            $table->string('phone')->unique();
            $table->string('phone_alternate')->nullable();

            // Removed 'role' column as per second migration

            $table->string('home')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->string('profile')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Create the pivot table for employees and roles
        Schema::create('employee_role', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->primary(['employee_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_role');
        Schema::dropIfExists('employees');
    }
};
