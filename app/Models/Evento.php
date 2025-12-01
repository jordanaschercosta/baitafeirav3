<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'imagem_url',
        'slug',
        'inicio',
        'fim',
        'descricao',
        'status',
        'user_id',
        'cep',
        'rua',
        'bairro',
        'numero',
        'cidade',
        'uf',
        'latitude',
        'longitude'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participacoes()
    {
        return $this->hasMany(Participacao::class, 'evento_id', 'id');
    }

    /**
     * Retorna o endereço completo do evento.
     */
    public function getEnderecoAttribute()
    {
        $partes = [
            $this->rua,
            $this->numero,
            $this->cidade,
        ];

        // Remove valores nulos e concatena com vírgula
        return implode(', ', array_filter($partes));
    }

    /**
     * Exibe o campo 'inicio' formatado.
     */
    public function getInicioAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }

    /**
     * Exibe o campo 'fim' formatado.
     */
    public function getFimAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }

     // Gera automaticamente o slug ao criar
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($evento) {
            $enderecoPart = collect([
                $evento->rua ?? '',
                $evento->bairro ?? '',
                $evento->cidade ?? '',
            ])->filter()->map(fn($item) => Str::slug($item, '-'))->implode('-');
            $slugBase = Str::slug($evento->titulo, '-');
            $data = Carbon::createFromFormat('d/m/Y H:i', $evento->inicio)->format('Y-m-d');
            $evento->slug = "{$slugBase}-{$data}-{$enderecoPart}";
        });

        static::updating(function ($evento) {
            $enderecoPart = collect([
                $evento->rua ?? '',
                $evento->bairro ?? '',
                $evento->cidade ?? '',
            ])->filter()->map(fn($item) => Str::slug($item, '-'))->implode('-');
            $slugBase = Str::slug($evento->titulo, '-');
            $data = Carbon::createFromFormat('d/m/Y H:i', $evento->inicio)->format('Y-m-d');
            $evento->slug = "{$slugBase}-{$data}-{$enderecoPart}";
        });
    }
}
