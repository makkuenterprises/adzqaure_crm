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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            $table->foreignId('project_id')->nullable()->references('id')->on('projects');
            $table->enum('type',['Credit','Debit'])->nullable();
            $table->double('amount',16,2)->nullable();
            $table->string('remark')->nullable();
            $table->enum('method',['UPI','Cash','Cheque','Bank Transfer'])->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
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
