<?php

namespace App\Services;

use Illuminate\Support\Str;
use Exception;

class UploadService
{
    /**
     * Faz upload de uma imagem em base64.
     *
     * @param string $image
     * @return string URL pública da imagem
     * @throws Exception
     */
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

            // Decodifica a imagem
            $imageData = substr($image, strpos($image, ',') + 1);
            $decoded = base64_decode($imageData);

            if ($decoded === false) {
                throw new Exception('Falha ao decodificar imagem.');
            }

            // Nome único do arquivo
            $filename = Str::uuid() . '.' . $extension;

            // Caminho para gravar o arquivo
            $uploadDir = public_path('uploads');

            // Cria a pasta se não existir
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // cria pasta recursivamente
            }

            // Caminho completo do arquivo
            $filePath = $uploadDir . '/' . $filename;

            // Grava o arquivo
            file_put_contents($filePath, $decoded);

            // Retorna URL pública
            return asset('uploads/' . $filename);

        } catch (Exception $e) {
            throw $e;
        }
    }
}
