<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participacao extends Model
{
    use HasFactory;

    protected $table = 'participacoes';

    protected $fillable = [
        'user_id',	
        'evento_id',
        'bancas'
    ];

    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id');
    }
}
