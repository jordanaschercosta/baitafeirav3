<?php

namespace App\Services;

use App\Models;

class NotificacaoService
{
    protected $crudService;

    public function __construct(CRUDService $crudService)
    {
        $this->crudService = $crudService;
    }

    public function enviarNotificacao($obj, string $tipo)
    {
        $destinatarios = $this->getListaTransmissao($obj);

        foreach ($destinatarios as $userId) {
            $this->crudService->createNotificacao($tipo, $obj, $userId);
        }
    }

    protected function getListaTransmissao($obj) {
        $user_ids = [];
        if ($obj instanceof Models\Evento) {
            foreach ($obj->participacoes as $participacao) {
                $user_ids[] = $participacao->usuario->id; 
            }
        }

        return $user_ids;
    }
}