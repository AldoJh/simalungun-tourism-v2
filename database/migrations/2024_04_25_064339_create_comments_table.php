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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
