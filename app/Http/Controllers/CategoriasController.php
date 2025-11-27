<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    //
    public function index()
    {
        $categorias = $this->crudService->getCategorias();

        $ordenar = request()->query('ordenar');

        if (!empty($ordenar) && $ordenar == "mais_perto") {
            $proximosEventos =  $this->crudService->getEventosByLocalizacao(session('user_lat'), session('user_lng'));
        } else {
            $proximosEventos =  $this->crudService->getEventos();
        }

        return view('categorias.index', compact('categorias', 'proximosEventos'));
    }

    public function show($slug) {
        $categoria = $this->crudService->getCategoriaBySlug($slug);

        $bancas = $this->crudService->getBancasByCategoria($categoria->id);

        $bancasIds = [];

        foreach ($bancas as $banca) {
            $bancasIds[] = $banca->id;
        }

        return view('categorias.show', compact('categoria', 'bancas'));
    }
}
