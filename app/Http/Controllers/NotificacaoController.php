<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    /**
     * Lista todas notificações
     */
    public function index()
    {
        $notificacoes = $this->crudService->getNotificacoes();

        $this->crudService->lerNotificacoes();

        return view('notificacoes.index', compact('notificacoes'));
    }

    /**
     * Lista todas notificações
     */
    public function getNotificacoesNaoLidas()
    {
        $notificacoes = $this->crudService->getNotificacoes(true);

        return response()->json([
            'status' => true,
            'data'   => $notificacoes
        ]);
    }
}