<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('favoritos', function (Blueprint $table) {

            // Ajusta banca_id para nullable
            $table->unsignedBigInteger('banca_id')
                ->nullable()
                ->change();

            // Ajusta produto_id para nullable
            $table->unsignedBigInteger('produto_id')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('favoritos', function (Blueprint $table) {

            $table->unsignedBigInteger('banca_id')
                ->nullable(false)
                ->change();

            $table->unsignedBigInteger('produto_id')
                ->nullable(false)
                ->change();
        });
    }
};
