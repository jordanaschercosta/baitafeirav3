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
        $idsLidas = [];
        if (!empty(session('notificacoes_lidas'))) {
            $idsLidas = json_decode(session('notificacoes_lidas'));
        }

        $notificacoes = $this->crudService->getNotificacoesNaoLidas($idsLidas);

        return response()->json([
            'status' => true,
            'data'   => $notificacoes
        ]);
    }

    /**
     * Marca a notificação como lida
     */
    public function lido()
    {
        $notificacoes = $this->crudService->getNotificacoesNaoLidas([]);
        $idsLidas = $notificacoes->pluck('id')->toArray();

        session([
            'notificacoes_lidas' => json_encode($idsLidas),
        ]);

        return response()->json([
            'mensagem' => 'Notificação marcada como lida',
            'data' => ''
        ]);
    }
}