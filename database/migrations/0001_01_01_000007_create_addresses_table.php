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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('customers','id')
                                            ->onDelete('cascade')
                                            ->onUpdate('cascade');
            $table->string('road');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('cep')->unique();
            $table->string('complement');
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
        Schema::dropIfExists('addresses');
    }
};