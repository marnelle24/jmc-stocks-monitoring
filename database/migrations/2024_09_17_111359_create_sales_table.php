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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sales_order_no')->unique();
            $table->string('customer_name')->nullable();
            $table->decimal('total_discount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->timestamp('sale_date');
            $table->string('payment_method')->default('cash');
            $table->enum('status', ['pending', 'completed', 'refunded'])->default('completed');
            $table->string('created_by')->nullable();
            $table->string('approved_buy')->nullable();
            $table->timestamps();

            // Foreign key constraint
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
