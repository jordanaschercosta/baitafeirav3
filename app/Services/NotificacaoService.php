<?php

namespace App\Services;

use App\Models;
use App\Models\Enum\StatusEvento;
use App\Models\Enum\TipoNotificacao;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class NotificacaoService
{
    protected CRUDService $crudService;
    protected EmailService $emailService;

    public function __construct(CRUDService $crudService, EmailService $emailService)
    {
        $this->crudService = $crudService;
        $this->emailService = $emailService;
    }

    public function enviarNotificacao($obj, string $tipo)
    {
        $destinatarios = $this->getListaTransmissao($obj);
        
        /** @var \App\Models\User[] $destinatarios */
        foreach ($destinatarios as $destinario) {

            if ($destinario instanceof \App\Models\Favorito) {

                $obj = [
                    'favorito' => $destinario,
                    'participacao' => $obj
                ];

                $destinario = $destinario->user;
            }

            try {
                echo $destinario->email;
                echo "\n";
                $this->crudService->createNotificacao($tipo, $obj, $destinario);
                if ($tipo == TipoNotificacao::EVENTO_CANCELADO) {
                    $this->emailService->cancelamentoEvento($destinario, $obj);
                } else if ($tipo == TipoNotificacao::EVENTO_REAGENDADO) {
                    $this->emailService->atualizacaoEvento($destinario, $obj);
                }
            } catch (Exception $exception) {
                //
                var_dump($exception);
                exit;
            }
            
        }
    }

    /**
      * @param mixed $obj
      * @return array
    */
    protected function getListaTransmissao($obj) : array
    {
        $users = [];

        if ($obj instanceof Models\Evento) {
            foreach ($obj->participacoes as $participacao) {
                $users[] = $participacao->usuario; 
            }
        }

        if ($obj instanceof Models\Participacao) {
            $bancasFavoritados = [];
            if (!empty($obj->bancas)) {
                $bancasIds = json_decode($obj->bancas);
                foreach ($bancasIds as $bancaId) {
                    $favoritados = $this->crudService->getFavoritadoByBancaId($bancaId);
                    foreach($favoritados as $favoritado) {
                        $bancasFavoritados[] = $favoritado;
                    }
                }

                return $bancasFavoritados;
            }
        }

        if ($obj instanceof Models\Produto) {
            $favoritados = $this->crudService->getFavoritadoByProdutoId($obj->id);
            foreach($favoritados as $favoritado) {
                $users[] = $favoritado->user; 
            }
        }

        return $users;
    }


    protected function enviarWPMessage($obj, $tipo, $phone) 
    {
        $sid   = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');

        $from  = 'whatsapp:+14155238886';

        $phone = preg_replace('/\D/', '', $phone);

        if (!empty($phone)) {
            return false;
        }

        // envio teste
        // $phone = '555196363031';

        $to = "whatsapp:+{$phone}";

        try {

            $twilio = new Client($sid, $token);

            $twilio->messages->create($to, [
                'from' => $from,
                'body' => $this->montarMensagem($obj, $tipo)
            ]);

            return true;

        } catch (\Exception $e) {

            Log::error('Erro ao enviar WhatsApp', [
                'to'    => $to,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    protected function montarMensagem($obj, $tipo)
    {
        if ($tipo == TipoNotificacao::EVENTO_LEMBRETE) {
            return "*BAITA-FEIRA AVISA*\n\n"
                . "📅 *Você tem um evento marcado para hoje!*\n\n"
                . "🎉 {$obj->titulo}\n"
                . "📍 {$obj->endereco}\n"
                . "⏰ {$obj->inicio}\n\n"
                . "👉 Ver detalhes do evento:\n"
                . route("eventos.show", $obj->slug);
        } else if ($tipo == TipoNotificacao::EVENTO_CANCELADO) {
            return "*BAITA-FEIRA AVISA*\n\n"
                . "📅❌ * O evento {$obj->titulo} foi cancelado!*\n\n"
                . "👉 Ver detalhes em:\n"
                . route("eventos.show", $obj->slug);
        } else if ($tipo == TipoNotificacao::FAVORITO_EVENTO) {
            $banca = $obj['favorito']->banca;
            $obj = $obj['participacao']->evento;

            return "*BAITA-FEIRA AVISA*\n\n"
                . "📅 *Sua banca favorita {$banca->nome_fantasia} estará presente!*\n\n"
                . "🎉 Evento: {$obj->titulo}\n\n"
                . "👉 Ver detalhes em:\n"
                . route("eventos.show", $obj->slug);
        } else if ($tipo == TipoNotificacao::PRODUTO_PROMOCAO) {
            return "teste";
            return "*BAITA-FEIRA AVISA* 💸\n\n"
                . "🏷️ *PROMOÇÃO: {$obj->nome} com desconto!*\n\n"
                . "👉 Ver detalhes em:";
        }

        return "";
    }
}