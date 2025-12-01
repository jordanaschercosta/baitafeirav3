<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Evento;
use App\Models\Favorito;
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
            'instagram'     => $request->instagram,
            'categoria_id'  => $request->categoria_id,
        ]);

        try {
            $banca->foto_url = $this->uploadService->uploadBlobImage($request->cropped_image);
            $banca->save();
        } catch (Exception $e) {
            return redirect()->route('bancas.create', $banca->id)->with('error', $e->getMessage());
        }

        return redirect()->route('bancas.produtos.index', $banca)->with('success', 'Banca cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $banca = $this->crudService->getBancaBySlug($slug);

        $favorito = null;

        if (session('user_id')) {
            $favorito = Favorito::where('banca_id', $banca->id)
                ->where('user_id', session('user_id'))
                ->first();
        }

        // $banner = asset('images/banners/banca.jpg');

        $evento = null;
        if (request()->has('evento')) {
            $evento = Evento::find(request()->evento);
        }

        return view('bancas.show', compact('banca', 'evento', 'favorito'));
    }

   /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banca = $this->crudService->getBancaById($id);

        $this->validaOwner($banca);

        $categorias = Categoria::all();

        return view('bancas.edit', compact('banca', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banca = $this->crudService->getBancaById($id);

        $this->validaOwner($banca);

        $banca->nome_fantasia = $request->nome_fantasia;
        $banca->descricao     = $request->descricao;
        $banca->instagram     = $request->instagram;
        $banca->categoria_id  = $request->categoria_id;

        try {
            if ($request->cropped_image) {
                $banca->foto_url = $this->uploadService->uploadBlobImage($request->cropped_image);
            }
            $banca->save();
        } catch (Exception $e) {
            return redirect()->route('bancas.edit', $banca->id)->with('error', $e->getMessage());
        }

        return redirect()->route('bancas.index')->with('success', 'Banca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banca $banca)
    {
        //
    }
}
