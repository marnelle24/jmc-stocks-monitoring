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
            $table->unsignedTinyInteger('supplier_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->double('selling_price')->default(0);
            $table->double('buying_price')->default(0);
            $table->string('currency')->default('PHP');
            $table->text('description')->nullable();
            $table->string('unit')->default('pcs');
            $table->string('keyword')->nullable();
            $table->string('addedBy');
            $table->string('lastUpdatedBy')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('isActive')->default(1);
            $table->boolean('isSearchable')->default(1);
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
