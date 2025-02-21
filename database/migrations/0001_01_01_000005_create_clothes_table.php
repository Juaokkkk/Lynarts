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
        Schema::create('clothes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_style')->constrained('styles','id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('id_size')->constrained('sizes','id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('description');
            $table->string('path')->nullable();
            $table->decimal('price', 10,2);
            $table->timestamp('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes');
    }
};
