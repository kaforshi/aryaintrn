<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->json('typewriter_words')->nullable(); // Array of words for typewriter effect
            $table->string('email')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('verified')->default(false);
            $table->boolean('status_online')->default(true);
            $table->string('footer_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
