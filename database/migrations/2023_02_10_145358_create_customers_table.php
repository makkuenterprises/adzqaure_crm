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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('phone_alternate')->nullable();
            $table->string('password')->nullable();
            $table->string('profile')->nullable();

            $table->string('company_name')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->json('other')->nullable();

            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('google_chat_space_url')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->boolean('status')->default(true);

            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE customers AUTO_INCREMENT = 200001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
