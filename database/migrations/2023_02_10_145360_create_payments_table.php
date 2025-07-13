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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->enum('type',['Credit','Debit'])->nullable();
            $table->double('amount',16,2)->nullable();
            $table->string('remark')->nullable();
            $table->enum('method',['UPI','Cash','Cheque','Bank Transfer'])->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE payments AUTO_INCREMENT = 100001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
