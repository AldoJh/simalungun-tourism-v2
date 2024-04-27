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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('slug')->unique();
            $table->date('date');   
            $table->integer('price');    
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable(); 
            $table->string('description')->nullable();
            $table->string('image', 50)->nullable();         
            $table->string('updated_by')->default('system');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
