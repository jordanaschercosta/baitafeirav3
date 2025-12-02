<?php

namespace App\Models\Enum;

class TipoNotificacao {
    const EVENTO = "evento_criado";
    const EVENTO_REAGENDADO = "evento_reagendado";
    const EVENTO_LEMBRETE = "evento_lembrete";
    const EVENTO_CANCELADO = "evento_cancelado";
    const FAVORITO_EVENTO = "favorito_evento";
    const ALTERACAO_PARTICIPACAO = "participacao_alteracao";
}