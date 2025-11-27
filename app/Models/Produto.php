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
        'preco'
    ];

    public function banca()
    {
        return $this->belongsTo(Banca::class, 'banca_id', 'id');
    }
}
