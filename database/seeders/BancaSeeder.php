<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banca;
use App\Models\User;
use App\Models\Categoria;

class BancaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categoria = Categoria::first();

        if (!$user || !$categoria) {
            return;
        }

         $imagens = [
            'banca1.jpg',
            'banca2.jpg',
            'banca3.jpg',
        ];

        $nomes = [
            'Arte da Terra','Moda Plus','Doce Encanto','Pet Feliz','Beleza Natural','Sabor Caseiro',
            'Estilo Urbano','Flor & Cor','Essência Viva','Mania de Crochê','Casa Criativa',
            'Delícias da Vó','Bicho Chic','Look Artesanal','Brilho Natural','Temperos & Sabores',
            'Estação Moda','Ateliê da Ana','Encantos do Lar','Pet & Cia',
            'Moda Curvy','Doces & Sonhos','Mimos e Afetos','Beleza Raiz','Sabor Colonial',
            'Urban Style','Arte em Fios','Lar Doce Lar','Pet Mania','Forma Natural',
            'Plus Fashion','Gula Criativa','Ateliê Criar','Casa & Afeto','Bichos Mimados',
            'Fashion Line','Fios & Tramas','Temper Art','Estilo Livre','Vida Natural'
        ];

        foreach ($nomes as $nome) {

            Banca::create([
                'user_id' => $user->id,
                'categoria_id' => $categoria->id,

                'nome_fantasia' => $nome,
                'foto_url' => $imagens[array_rand($imagens)],

                'descricao' => 'Produtos artesanais e autorais desenvolvidos com carinho pela banca ' . $nome . '.',
                'instagram' => '@' . str_replace(' ', '', strtolower($nome))
            ]);
        }
    }
}
