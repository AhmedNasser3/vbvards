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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // ربط السلة بالمستخدم
            $table->string('product_name');  // اسم المنتج
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // معرف المنتج
            $table->integer('quantity');  // كمية المنتج
            $table->decimal('price', 10, 2);  // سعر المنتج
            $table->string('color')->nullable();  // اللون المختار
            $table->string('size')->nullable();  // الحجم المختار
            $table->string('vendor')->nullable();  // اسم البائع
            $table->string('image')->nullable();  // صورة المنتج
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
};