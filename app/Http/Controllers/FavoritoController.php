<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Banca;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Lista favoritos do usuário logado.
     */
    public function index()
    {
        $favoritos = Favorito::with('banca')
            ->where('user_id', session('user_id'))
            ->whereNotNull('banca_id')
            ->get();

        $produtosFavoritos = Favorito::with('produto')
            ->where('user_id', session('user_id'))
            ->whereNotNull('produto_id')
            ->get();

        return view('favoritos.index', compact('favoritos', 'produtosFavoritos'));
    }

    /**
     * Marca uma banca como favorita.
     */
    public function store(Request $request)
    {
        $userId = session('user_id');

        if ($request->produto_id) {
            $campo = 'produto_id';
            $id = $request->produto_id;
            $existeFavorito = Produto::where('id', $id)->first();
        } else {
            $campo = 'banca_id';
            $id = $request->banca_id;
            $existeFavorito = Banca::where('id', $id)->first();
        }

        if (empty($existeFavorito)) {
            return back()->with('error', 'Favorito não encontrado!');
        }

        $existe = Favorito::where('user_id', $userId)
            ->where($campo, $id)
            ->first();

        if (!$existe) {
            Favorito::create([
                'user_id' => $userId,
                $campo => $id,
            ]);
        }

        return back()->with('success', 'Adicionado aos favoritos!');
    }

    /**
     * Remove um favorito.
     */
    public function destroy(Favorito $favorito)
    {
        // Garante que o usuário só pode deletar os próprios favoritos
        if ($favorito->user_id !== session('user_id')) {
            abort(403, 'Acesso negado');
        }

        $favorito->delete();

        return back()->with('success', 'Removido dos favoritos.');
    }
}