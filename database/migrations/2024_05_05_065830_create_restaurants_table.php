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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('owner')->nullable();
            $table->string('address');
            $table->string('description')->nullable();
            $table->string('excerpt')->nullable();            
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('village_id')->unsigned()->nullable();           
            $table->integer('chair');
            $table->integer('table'); 
            $table->boolean('label')->default(1);
            $table->boolean('is_recomended')->default(0);      
            $table->timestamps();

            $table->index('name');
            $table->index('slug');
            $table->index('is_recomended');
                
            $table->foreign('district_id')
            ->references('id')
            ->on('districts')
            ->onDelete('set null')
            ->onUpdate('cascade');
        
            $table->foreign('village_id')
            ->references('id')
            ->on('villages')
            ->onDelete('set null')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
