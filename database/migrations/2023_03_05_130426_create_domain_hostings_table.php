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
        Schema::create('domain_hostings', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->foreignId('customer_id')->nullable();

            $table->string('domain_name')->nullable();
            $table->date('domain_purchase')->nullable();
            $table->date('domain_expiry')->nullable();
            $table->string('domain_provider')->nullable();
            $table->double('domain_renewal_price',16,2)->nullable();
            
            $table->date('hosting_purchase')->nullable();
            $table->date('hosting_expiry')->nullable();
            $table->string('hosting_provider')->nullable();
            $table->double('hosting_renewal_price',16,2)->nullable();
            
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
        Schema::dropIfExists('domain_hostings');
    }
};
