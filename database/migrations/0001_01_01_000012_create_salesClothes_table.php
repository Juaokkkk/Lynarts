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
        Schema::create('sales_clothing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sale')->constrained('sales','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('id_clothing')->constrained('clothes','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('amount');
            $table->timestamp('created_at');
            $table->dateTime('updated_at');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesClothes');
    }
};