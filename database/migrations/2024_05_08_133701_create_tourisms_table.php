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
        Schema::create('tourisms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("category_id")->unsigned()->nullable();
            $table->string('name');
            $table->string('address');
            $table->text('description');
            $table->text('excerpt');            
            $table->string('slug')->unique();
            $table->string('image')->nullable(true);
            $table->string('phone');
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('village_id')->unsigned()->nullable();  
            $table->boolean('is_recomended')->default(false);     
            $table->timestamps();

            $table->index('name');
            $table->index('slug');
            $table->index('is_recomended');

            $table->foreign('category_id')
            ->references('id')
            ->on('tourism_categories')
            ->onDelete('set null')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('tourisms');
    }
};
