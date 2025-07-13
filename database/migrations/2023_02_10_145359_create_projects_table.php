<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers') // Add this
                  ->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('project_link')->nullable();
            $table->string('resource_link')->nullable();
            $table->date('end_date')->nullable();
            $table->double('amount', 16, 2)->nullable();
            //$table->double('pending_amount', 16, 2)->nullable();
            $table->enum('status', ['OnProgress', 'Pending', 'Closed'])->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE projects AUTO_INCREMENT = 100001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
