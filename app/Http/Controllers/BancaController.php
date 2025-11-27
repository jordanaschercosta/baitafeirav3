<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Evento;
use Exception;

class BancaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bancas = $this->crudService->getBancasUsuario(session('user_id'));

        return view('bancas.index', compact('bancas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('bancas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banca = $this->crudService->createBanca([
            'user_id'       => session('user_id'),
            'nome_fantasia' => $request->nome_fantasia,
            'foto_url'      => '',
            'descricao'     => $request->descricao,
            'endereco'      => $request->endereco,
            'telefone'      => $request->telefone,
            'instagram'     => $request->instagram,
            'categoria_id'  => $request->categoria_id,
            'bairro'        => $request->bairro,
            'cidade'        => $request->cidade,
            'numero'        => $request->numero,
        ]);

        try {
            $banca->foto_url = $this->uploadService->uploadBlobImage($request->cropped_image);
            $banca->save();
        } catch (Exception $e) {
            return redirect()->route('bancas.create', $banca->id)->with('error', $e->getMessage());
        }

        return redirect()->route('bancas.index')->with('success', 'Banca cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $banca = $this->crudService->getBancaBySlug($slug);

        $evento = null;
        if (request()->has('evento')) {
            $evento = Evento::find(request()->evento);
        }

        return view('bancas.show', compact('banca', 'evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banca $banca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banca $banca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banca $banca)
    {
        //
    }
}
