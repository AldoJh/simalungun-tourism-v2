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
        Schema::create('tourism_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourism_id');
            $table->string('image');
            $table->string('name');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('country');
            $table->string('religion');
            $table->string('status');
            $table->string('phone');
            $table->timestamps();

            $table->foreign('tourism_id')
            ->references('id')
            ->on('tourisms')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_guides');
    }
};
