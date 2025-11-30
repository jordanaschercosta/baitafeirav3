<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';

    protected $fillable = [
        'user_id',
        'banca_id',
    ];

    /**
     * Relacionamento: um favorito pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: um favorito pertence a uma banca.
     */
    public function banca()
    {
        return $this->belongsTo(Banca::class);
    }
}
