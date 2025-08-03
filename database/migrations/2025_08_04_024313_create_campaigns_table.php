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
    Schema::create('campaigns', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->foreignId('whatsapp_template_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['draft', 'processing', 'completed', 'failed'])->default('draft');
        $table->json('dynamic_data')->nullable(); // Stores static values for placeholders
        $table->timestamp('completed_at')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
};
