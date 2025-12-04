<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use Illuminate\Support\Str;
use App\Models\Categoria;

class Banca extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome_fantasia',
        'foto_url',
        'descricao',
        'instagram',
        'categoria_id',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($banca) {
            $slugBase = Str::slug($banca->nome_fantasia, '-');
            $rand = rand(1000, 10000);
            $banca->slug = "{$slugBase}-{$rand}";
        });

        static::updating(function ($banca) {
            $slugBase = Str::slug($banca->nome_fantasia, '-');
            $rand = rand(1000, 10000);
            $banca->slug = "{$slugBase}-{$rand}";
        });
    }
}
