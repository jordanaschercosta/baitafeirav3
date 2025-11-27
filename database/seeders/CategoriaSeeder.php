<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['Artesanato e Decoração', 'artesanato.jpg'],
            ['Moda e Acessórios', 'moda.jpg'],
            ['Alimentos e Bebidas', 'alimentacao.jpg'],
            ['Beleza e Cuidados Pessoais', 'cuidados.jpg'],
            ['Pets', 'pets.jpg'],
            ['Mesa e Cozinha', 'cozinha.jpg']
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'nome' => $categoria[0], 
                'imagem' => 'images/categorias/' . $categoria[1]
            ]);
        }
    }
}
