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
        Schema::create('collection_products', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('collection_id');
            $table->timestamps();

            $table->unique(['product_id', 'collection_id']);
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_products');
    }
};
