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
        Schema::create('tourism_viewers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tourism_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('tourism_id')
                ->references('id')
                ->on('tourisms')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_viewers');
    }
};
