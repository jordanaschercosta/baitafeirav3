<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->integer('produto_id')->after('banca_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->dropColumn('produto_id');
        });
    }
};
