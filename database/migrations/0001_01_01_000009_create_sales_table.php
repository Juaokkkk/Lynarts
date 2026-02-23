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
            $table->foreignId('id_user')->constrained('users','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('id_customer')->constrained('customers','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->decimal('totalValue')->nullable();
            $table->string('situation')->default("ABERTA");
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
        Schema::dropIfExists('sales');
    }
};