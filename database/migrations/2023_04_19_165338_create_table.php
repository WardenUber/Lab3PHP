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
        Schema::create('dealerships', function (Blueprint $category) {
            $category->id();
            $category->string('name');
            $category->string('address');
            $category->string('brand');
        });
        Schema::create('cars', function (Blueprint $product) {
            $product->id();
            $product->string('name');
            $product->string('model');
            $product->string('brand');
            $product->biginteger('power');
            $product->biginteger('volume');
            $product->foreignId('dealerships_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
        Schema::dropIfExists('dealerships');
    }
};
