<?php

namespace App\Http\Controllers;

use App\Models\Enum\StatusEvento;
use App\Models\Enum\TipoNotificacao;
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
        if (isUserOrganizador()) {
            $proximosEventos = $this->crudService->getEventosByUser(session('user_id'));
        } else {
            $proximosEventos = $this->crudService->getParticipacoesEventos(session('user_id'));
        }

        return view('eventos.index', compact('proximosEventos'));
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
            'status' => StatusEvento::CONFIRMADO,
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
            'status' => StatusEvento::CONFIRMADO,
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

        // $this->crudService->createNotificacao(TipoNotificacao::EVENTO, $evento);

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

        $bancasIds = array_values(array_unique($bancasIds));

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
        $this->validaOwner($evento);

        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        $this->validaOwner($evento);

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

        $reagendado = false;
        if ($evento->inicio <> $request->inicio) {
            $reagendado = true;
        }

        // campos de endereço que devem ser comparados
        $camposEndereco = [
            'cep',
            'rua',
            'bairro',
            'numero',
            'cidade',
            'uf',
        ];

        foreach ($camposEndereco as $campo) {
            if ($evento->$campo <> $request->$campo) {
                $reagendado = true;
                break; // já achou uma diferença, não precisa continuar
            }
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

        if ($reagendado) {
            $evento = $this->crudService->getEventoById($evento->id);
            $this->notificacaoService->enviarNotificacao($evento, TipoNotificacao::EVENTO_REAGENDADO);
        }

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $evento = $this->crudService->getEventoById($id);

        $this->validaOwner($this->crudService->getEventoById($id));

        if ($evento->status == StatusEvento::CANCELADO) {
            $evento->delete();
            return redirect()
                ->route('eventos.index')
                ->with('success', 'Evento excluído com sucesso!');
        }
        
        // $this->crudService->cancelaEvento($id);
        $this->notificacaoService->enviarNotificacao($evento, TipoNotificacao::EVENTO_CANCELADO);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento cancelado com sucesso!');
    }
}
