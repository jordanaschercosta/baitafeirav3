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
            $table->dropColumn([
                'endereco',
                'telefone',
                'numero',
                'bairro',
                'cidade',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bancas', function (Blueprint $table) {
            $table->string('endereco', 255)->nullable(false);
            $table->string('telefone', 255)->nullable(false);
            $table->string('numero', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('cidade', 255)->nullable();
        });
    }
};
