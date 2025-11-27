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
        Schema::table('bancas', function (Blueprint $table) {
            // Remove a FK antiga (provavelmente tinha onDelete('cascade'))
            $table->dropForeign(['categoria_id']);

            // Permite valores nulos
            $table->unsignedBigInteger('categoria_id')->nullable()->change();

            // Recria a FK com SET NULL ao deletar a categoria
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->nullOnDelete(); // ou ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bancas', function (Blueprint $table) {
            // Remove a FK atual
            $table->dropForeign(['categoria_id']);

            // Volta a ser obrigatória
            $table->unsignedBigInteger('categoria_id')->nullable(false)->change();

            // Recria a FK antiga com delete em cascata
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }
};
