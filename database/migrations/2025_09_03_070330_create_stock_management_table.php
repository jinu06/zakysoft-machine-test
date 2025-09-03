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
        Schema::create('stock_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('CASCADE');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('CASCADE');
            $table->integer('quantity')->default(0);
            $table->enum('type', ['in', 'out'])->default('in')->index();
            $table->dateTime('movement_date')->default(now())->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_management');
    }
};
