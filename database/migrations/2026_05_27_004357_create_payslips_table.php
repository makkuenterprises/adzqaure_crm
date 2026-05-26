<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->unsignedTinyInteger('month'); // 1 to 12
            $table->unsignedSmallInteger('year');
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('allowances', 12, 2)->default(0.00);
            $table->decimal('deductions', 12, 2)->default(0.00);
            $table->decimal('net_salary', 12, 2);
            $table->unsignedTinyInteger('total_days');
            $table->unsignedTinyInteger('present_days');
            $table->unsignedTinyInteger('absent_days');
            $table->unsignedTinyInteger('half_days')->default(0);
            $table->unsignedTinyInteger('paid_leaves')->default(0);
            $table->enum('status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->timestamps();

            // Prevents duplicate payslips for the same employee in the same month
            $table->unique(['employee_id', 'month', 'year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payslips');
    }
};
