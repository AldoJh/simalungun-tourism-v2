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
        Schema::create('tourism_visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourism_id');
            $table->foreign('tourism_id')
                ->references('id')
                ->on('tourisms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('visitor');
            $table->string('attachment');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_visitors');
    }
};
