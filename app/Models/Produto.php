<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'banca_id',
        'nome',
        'descricao',
        'imagem_url',
        'preco',
        'em_promocao',
        'valor_novo'
    ];

    public function banca()
    {
        return $this->belongsTo(Banca::class, 'banca_id', 'id');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'produto_id', 'id');
    }
}
