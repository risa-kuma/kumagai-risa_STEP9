<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/2026_06_21_125739_add_user_id_to_products_table.php
public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        // すでにテーブルがある状態で追加する場合、nullable() を指定するのが安全です
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};