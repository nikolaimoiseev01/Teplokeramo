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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('collection_id')->nullable();
            $table->float('price')->nullable();
            $table->float('packaged')->nullable();
            $table->integer('article')->nullable();
            $table->string('type')->nullable();
            $table->float('weight')->nullable();
            $table->float('thickness')->nullable();
            $table->string('color')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('slug')->nullable();
            $table->json('area_of_use')->nullable();
            $table->string('style')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
