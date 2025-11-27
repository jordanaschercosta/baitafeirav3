<?php

namespace App\Http\Controllers;

use App\Models;
use App\Services\ProdutoService;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Models\Banca $banca)
    {
        return view('produtos.create', ['banca' => $banca]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = $this->crudService->createProduto([
            'banca_id'      => $request->banca_id,
            'nome'          => $request->nome,
            'descricao'     => $request->descricao,
            'imagem_url'    => '',
            'preco'         => $request->preco
        ]);

        try {
            $produto->imagem_url = $this->uploadService->uploadBlobImage($request->cropped_image);
            $produto->save();
        } catch (Exception $e) {
            return redirect()->route('produtos.create', $request->banca_id)->with('error', $e->getMessage());
        }

        return redirect()->route('bancas.show', $produto->banca->slug)->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Models\Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Models\Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models\Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models\Produto $produto)
    {
        //
    }
}
