<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('title');
            $table->string('subtitle');
            $table->string('btn_txt')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('vid_btn_txt')->nullable();
            $table->string('vid_btn_url')->nullable();
            $table->string('banner_item_title')->nullable();
            $table->string('banner_item_subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('round_txt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
