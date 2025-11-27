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
        Schema::table('eventos', function (Blueprint $table) {
            $table->string('cep', 9)->nullable();
            $table->string('rua', 150)->nullable();
            $table->string('bairro', 150)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('cidade', 150)->nullable();
            $table->char('uf', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn([
                'cep',
                'rua',
                'bairro',
                'numero',
                'cidade',
                'uf',
            ]);
        });
    }
};
