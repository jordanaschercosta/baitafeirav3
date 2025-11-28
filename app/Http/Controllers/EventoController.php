<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Exception;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->crudService->createNotificacao([]);

        if (isUserOrganizador()) {
            $proximosEventos = $this->crudService->getEventosByUser(session('user_id'));
            return view('eventos.index_admin', compact('proximosEventos'));
        }
        
        $proximosEventos = $this->crudService->getProximosEventos(session('user_id'));
        $participacoes = $this->crudService->getMeusEventos(session('user_id'));

        return view('eventos.index', compact('proximosEventos', 'participacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inicio' => 'required|date|after_or_equal:today',
            'fim' => 'required|date|after:inicio',
            'imagem_url' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ]);

        $latitude = null;
        $longitude = null;
        $coordenadas = $this->geoLocalizacaoService->getCoordenadas($request->rua . ' ' . $request->numero . ' ' . $request->cidade);
        if (!empty($coordenadas)) {
            $latitude = $coordenadas['latitude'];
            $longitude = $coordenadas['longitude'];
        }

        $evento = $this->crudService->createEvento([
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'descricao' => $request->descricao,
            'status' => 'Confirmado',
            'user_id' => session('user_id'),
            'cep' => $request->cep,
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'numero' => $request->numero,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude
        ]);

        if (!empty($request->cropped_image)) {
            try {
                $evento->imagem_url = $this->uploadService->uploadBlobImage($request->cropped_image);
                $evento->save();
            } catch (Exception $e) {
                return redirect()->route('eventos.create', $evento->id)->with('error', $e->getMessage());
            }
        }

        return redirect()->route('eventos.index')->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $evento = $this->crudService->getEventoBySlug($slug);

        $bancasIds = [];

        foreach ($evento->participacoes as $participacao) {
            if (empty($participacao->bancas)) {
                continue;
            }
            $bancas = json_decode($participacao->bancas);
            foreach ($bancas as $banca) {
                $bancasIds[] = $banca;
            }
        }

        $listaBancas = [];
        foreach ($bancasIds as $bancaId) {
            $banca = $this->crudService->getBancaById($bancaId);
            if (!empty($banca)) {
                $listaBancas[] = $this->crudService->getBancaById($bancaId);
            }
        }

        $participacao = null;
        if (!empty(session('user_id'))) {
            $participacao = $this->crudService->getParticipacaoUsuarioEvento(session('user_id'), $evento->id);            
        }

        return view('eventos.show', compact('evento', 'listaBancas', 'participacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'inicio' => 'required|date|after_or_equal:today',
            'fim' => 'required|date|after:inicio',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ]);

        $latitude = null;
        $longitude = null;
        $coordenadas = $this->geoLocalizacaoService->getCoordenadas($request->rua . ' ' . $request->numero . ' ' . $request->cidade);
        if (!empty($coordenadas)) {
            $latitude = $coordenadas['latitude'];
            $longitude = $coordenadas['longitude'];
        }

        $this->crudService->atualizarEvento($evento->id, [
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'descricao' => $request->descricao,
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude
        ]);

        if (!empty($request->cropped_image)) {
            try {
                $evento->imagem_url = $this->uploadService->uploadBlobImage($request->cropped_image);
                $evento->save();
            } catch (Exception $e) {
                return redirect()->route('eventos.create', $evento->id)->with('error', $e->getMessage());
            }
        }

        return redirect()
            ->route('eventos.show', $evento->slug)
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->crudService->deleteEvento($id);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento cancelado com sucesso!');
    }
}
