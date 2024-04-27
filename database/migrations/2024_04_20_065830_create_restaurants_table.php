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
            $table->string('owner')->nullable(true);
            $table->string('address');
            $table->string('description')->nullable(true);
            $table->string('excerpt')->nullable(true);            
            $table->string('slug')->unique();
            $table->string('logo', 50)->nullable(true);
            $table->string('image', 50)->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('latitude')->nullable(true);
            $table->string('longitude')->nullable(true);
            $table->integer('province');
            $table->integer('district');
            $table->integer('subdistrict');
            $table->string('village');    
            $table->integer('chair');
            $table->integer('table'); 
            $table->integer("rating"); 
            $table->enum('label', [0, 1])->default(1);      
            $table->string('updated_by');
            $table->timestamps();
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
