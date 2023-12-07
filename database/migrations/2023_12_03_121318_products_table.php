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
              $table->unsignedBigInteger('category_id');
              $table->foreign('category_id')->references('id')->on('categories');
              $table->string('prod_name');
              $table->string('serial_num');
              $table->string('manufacturer');
              $table->integer('price');
              $table->integer('qty');
              $table->date('purchased_date');
              $table->text('note')->nullable();// Equipment Quantity
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
