<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // name -> product_name に変更
            $table->string('product_name'); 
            $table->integer('price');
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            // image -> img_path に変更
            $table->string('img_path')->nullable(); 
            $table->timestamps();
            
            // user_id と company_id が必要であればここで追加してください
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};