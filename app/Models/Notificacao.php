<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'tipo',
        'banca_id',
        'evento_id',
        'produto_id',
        'url'
    ];
}
