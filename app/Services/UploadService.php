<?php

namespace App\Services;

use App\Models;
use Exception;

class UploadService
{
    public function uploadBlobImage($image) : string
    {
        try {

            if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
                $image = substr($image, strpos($image, ',') + 1);
                $type = strtolower($type[1]);
            } else {
                return back()->with('error', 'Imagem inválida');
            }
    
            $image = base64_decode($image);
    
            $filename = uniqid() . '.' . $type;

            $path = public_path('storage/uploads/' . $filename);

            file_put_contents($path, $image);

            $publicUrl = asset('storage/uploads/' . $filename);

            return $publicUrl; 

        } catch (Exception $exception) {

            throw $exception;
        }
    }
}