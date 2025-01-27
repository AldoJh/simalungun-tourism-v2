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
        Schema::create('tourism_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourism_id');
            $table->foreign('tourism_id')
            ->references('id')
            ->on('tourisms')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_images');
    }
};
