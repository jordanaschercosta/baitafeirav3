<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoLocalizacaoService
{
    public function getCoordenadas(string $endereco)
    {
        $response = Http::withHeaders([
            'User-Agent' => 'BaitaFeira/1.0 (jordana@baitafeira.com)',
            'Accept-Language' => 'pt-BR',
        ])->get('https://nominatim.openstreetmap.org/search', [
            'format' => 'json',
            'q'      => $endereco,
            'limit'  => 1,
        ]);

        $data = $response;
        $data = $data->json();

        return [
            'latitude' => reset($data)['lat'], 
            'longitude' => reset($data)['lon']
        ];
    }
}