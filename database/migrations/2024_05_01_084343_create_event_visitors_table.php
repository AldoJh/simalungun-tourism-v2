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
        Schema::create('event_visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null')
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
        Schema::dropIfExists('event_visitors');
    }
};
