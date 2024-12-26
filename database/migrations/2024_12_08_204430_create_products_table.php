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
            $table->foreignId('collection_id');
            $table->float('price');
            $table->float('packaged');
            $table->integer('article');
            $table->string('type');
            $table->float('weight');
            $table->float('thickness');
            $table->string('color');
            $table->string('country_code');
            $table->string('country_name');
            $table->string('slug');
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
