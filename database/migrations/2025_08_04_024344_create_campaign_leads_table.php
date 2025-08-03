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
    Schema::create('campaign_leads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
        $table->foreignId('lead_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
        $table->text('failed_reason')->nullable();
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
        Schema::dropIfExists('campaign_leads');
    }
};
