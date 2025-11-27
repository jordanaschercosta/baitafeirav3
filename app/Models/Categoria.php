<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nome, '-');
        });

        static::updating(function ($banca) {
            $banca->slug = Str::slug($banca->nome, '-');
        });
    }
}
