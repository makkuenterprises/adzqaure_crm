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
    Schema::create('whatsapp_templates', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique(); // The exact name from Meta, e.g., 'promo_offer_v2'
        $table->string('display_name'); // User-friendly name, e.g., 'Promotional Offer'
        $table->text('body_text')->nullable(); // The template text with {{1}}, {{2}}
        $table->json('placeholders')->nullable(); // e.g., {"1": "Lead Name", "2": "Offer Code"}
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
        Schema::dropIfExists('whatsapp_templates');
    }
};
