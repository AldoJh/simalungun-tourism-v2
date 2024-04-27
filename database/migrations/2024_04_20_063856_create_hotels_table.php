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
        Schema::create('hotels', function (Blueprint $table) {
            $table->string('name', 45);
            $table->string('address');
            $table->string('description')->nullable(true);
            $table->string('excerpt')->nullable(true);            
            $table->string('slug')->unique();
            $table->string('logo', 50)->nullable(true);
            $table->string('foto', 50)->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('room');
            $table->string('bed');
            $table->string('latitude')->nullable(true);
            $table->string('longitude')->nullable(true);
            $table->integer("star");
            $table->integer('province');
            $table->integer('district');
            $table->integer('subdistrict');
            $table->string('village');      
            $table->string('owner')->nullable(true);
            $table->string('min_price')->nullable(true);
            $table->string('max_price')->nullable(true);
            $table->integer('male_employees')->nullable(true);
            $table->integer('female_employees')->nullable(true);   
            $table->integer('certification')->nullable(true);       
            $table->boolean('is_verified')->default(false);     
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
