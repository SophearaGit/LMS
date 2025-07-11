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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('map_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.a
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
