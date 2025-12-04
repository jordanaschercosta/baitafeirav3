<?php

namespace App\Services;

use Illuminate\Support\Str;
use Exception;

class UploadService
{
    public function uploadBlobImage(string $image): string
    {
        try {
            // Valida base64
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $matches)) {
                throw new Exception('Imagem base64 inválida.');
            }

            $extension = strtolower($matches[1]);
            $allowed   = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($extension, $allowed)) {
                throw new Exception('Formato de imagem não permitido.');
            }

            $image = substr($image, strpos($image, ',') + 1);
            $decodedImage = base64_decode($image);

            if ($decodedImage === false) {
                throw new Exception('Falha ao decodificar imagem.');
            }

            // Nome único
            $filename = Str::uuid() . '.' . $extension;

            // Define o diretório correto
            if (app()->environment('production')) {

                // HOSTINGER → public_html
                $uploadDir = base_path('../public_html/storage/uploads');

            } else {

                // LOCAL → public/storage
                $uploadDir = public_path('storage/uploads');
            }

            // Garantir que a pasta exista
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Caminho completo
            $path = $uploadDir . '/' . $filename;

            file_put_contents($path, $decodedImage);

            // URL pública funciona igual nos dois ambientes
            return asset('storage/uploads/' . $filename);

        } catch (Exception $e) {
            throw $e; // pode também logar se quiser
        }
    }
}
