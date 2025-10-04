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
        Schema::create('product_track_path', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_track_id')->constrained('product_track');
            $table->foreignId('path_id')->constrained('paths');
            $table->integer('position');
            $table->enum('visibility', ['visible', 'hidden'])->default('visible');
            $table->timestamps();

            $table->index(['product_track_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_track_path');
    }
};
