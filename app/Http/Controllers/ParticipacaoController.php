<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Participacao;
use Exception;

class ParticipacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $eventos = $this->crudService->getBancasUsuario(session('user_id'));

        // return view('evento_bancas.create', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $eventoId = $request->query('evento');
        $evento = $this->crudService->getEventoById($eventoId);

        if (!isUserExpositor()) {
            $this->crudService->createParticipacaoEvento([
                'evento_id' => $eventoId,
                'user_id' => session('user_id')
            ]);

            return redirect()->route('eventos.show', $evento->slug)->with('success', 'Participação confirmada com sucesso!');
        }

        // Busca o evento

        // Busca as bancas do usuário logado
        $bancas = $this->crudService->getBancasUsuario(session('user_id'));

        // Retorna a view
        return view('participacoes.create', [
            'bancas' => $bancas,
            'evento' => $evento
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit(int $participacaoId)
    {
        $participacao = $this->crudService->getParticipacaoById($participacaoId);
        $bancas = $this->crudService->getBancasUsuario(session('user_id'));

        if (!empty($bancas)) {
            return view('participacoes.edit', [
                'participacao' => $participacao,
                'bancas' => $bancas
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'banca_id' => 'required|array|min:1',
            'banca_id.*' => 'exists:bancas,id',
            'participacao_id' => 'required'
        ], [
            'banca_id.required' => 'Por favor, selecione pelo menos uma banca.',
            'banca_id.min' => 'Por favor, selecione pelo menos uma banca.',
            'banca_id.*.exists' => 'Banca inválida selecionada.',
        ]);

        $this->crudService->atualizarParticipacao($id, [
            'bancas' => json_encode($request->banca_id)
        ]);

        return redirect()->route('participacoes.edit', $id)->with('success', 'Participação atualizada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banca_id' => 'required|array|min:1', // obrigatório e pelo menos 1 item
            'banca_id.*' => 'exists:bancas,id',   // cada item deve existir na tabela 'bancas'
        ], [
            'banca_id.required' => 'Por favor, selecione pelo menos uma banca.',
            'banca_id.min' => 'Por favor, selecione pelo menos uma banca.',
            'banca_id.*.exists' => 'Banca inválida selecionada.',
        ]);

        $this->crudService->createParticipacaoEvento([
            'evento_id' => $request->evento_id,
            'user_id' => session('user_id'),
            'bancas' => json_encode($request->banca_id)
        ]);

        return redirect()->route('eventos.index')->with('success', 'Participação confirmada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $participacaoId)
    {
        try {
            $this->crudService->removerParticipacao([
                'id' => $participacaoId,
                'user_id' => session('user_id')
            ]);
        } catch (Exception $e) {
            return redirect()->route('eventos.index')->with('error', $e->getMessage());
        }

        return redirect()->route('eventos.index')->with('success', 'Participação cancelada com sucesso!');
    }
}
