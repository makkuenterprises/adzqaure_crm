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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->nullable();
            $table->text('service_details')->nullable();
            $table->unsignedBigInteger('service_category_id')->nullable();
            $table->decimal('service_price_in_inr', 10, 2);
            $table->decimal('service_price_in_usd', 10, 2)->nullable();
            $table->decimal('service_price_in_aud', 10, 2)->nullable();
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->boolean('govt_fee_applied')->default(false);
            $table->decimal('govt_fee', 10, 2)->nullable();
            $table->enum('service_status', ['active', 'inactive'])->default('active');
            $table->string('subscription_duration')->nullable();
            $table->text('documents_required')->nullable();
            $table->decimal('partner_margin_percentage', 5, 2)->nullable();
            $table->timestamps();
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};