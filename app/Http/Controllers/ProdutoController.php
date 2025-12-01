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
    public function index(int $bancaId)
    {
        $banca = $this->crudService->getBancaById($bancaId);

        $this->validaOwner($banca);

        return view('produtos.index', ['banca' => $banca]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Models\Banca $banca)
    {
        $this->validaOwner($banca);

        return view('produtos.create', ['banca' => $banca]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validaOwner($this->crudService->getBancaById($request->banca_id));

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

        return redirect()->route('bancas.produtos.index', [$produto->banca->id])->with('success', 'Produto cadastrado com sucesso!');
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
    public function edit(Models\Banca $banca, Models\Produto $produto)
    {
        $this->validaOwner($banca);

        return view('produtos.edit', ['banca' => $banca, 'produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models\Banca $banca, Models\Produto $produto)
    {
        $this->validaOwner($banca);

        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required',
            'valor_novo' => 'required_if:em_promocao,1|numeric|nullable'
        ]);

        $imagem_url = $produto->imagem_url;
        if (!empty($request->cropped_image)) {
            try {
                $imagem_url = $this->uploadService->uploadBlobImage($request->cropped_image);
            } catch (Exception $e) {
                //
            }
        }

        $this->crudService->atualizarProduto($produto->id, [
            'nome'          => $request->nome,
            'imagem_url'    => $imagem_url,
            'descricao'     => $request->descricao,
            'preco'         => $request->preco,
            'em_promocao'   => ($request->em_promocao) ? true : false,
            'valor_novo'    => $request->valor_novo
        ]);

        return redirect()
            ->route('bancas.produtos.index', ['banca' => $produto->banca])
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models\Banca $banca, int $id)
    {
        $this->validaOwner($banca);

        $this->crudService->deleteProduto($id);

        return redirect()
            ->route('bancas.produtos.index', ['banca' => $banca])
            ->with('success', 'Produto excluído com sucesso!');
    }
}
