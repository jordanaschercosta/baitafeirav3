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
        Schema::create('bancas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nome_fantasia');
            $table->string('foto_url');
            $table->string('descricao');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('instagram');
            $table->timestamps();
        });
    }
//EXPOSITORES= BAIRRO NO BANCO DE DADOS, COMPLEMENTO
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bancas');
    }
};
