<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Banca;
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
            ->get();

        return view('favoritos.index', compact('favoritos'));
    }

    /**
     * Marca uma banca como favorita.
     */
    public function store(Request $request)
    {
        $request->validate(['banca_id' => 'required|exists:bancas,id']);
        $userId = session('user_id');

        $existe = Favorito::where('user_id', $userId)
            ->where('banca_id', $request->banca_id)
            ->first();

        if (!$existe) {
            Favorito::create([
                'user_id' => $userId,
                'banca_id' => $request->banca_id,
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