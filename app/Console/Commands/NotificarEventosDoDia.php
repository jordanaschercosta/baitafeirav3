<?php

namespace App\Console\Commands;

use App\Models\Enum\TipoNotificacao;
use App\Services\CRUDService;
use App\Services\NotificacaoService;
use Illuminate\Console\Command;

class NotificarEventosDoDia extends Command
{
    protected CRUDService $crudService;
    protected NotificacaoService $notificacaoService;

    public function __construct(CRUDService $crudService, NotificacaoService $notificacaoService)
    {
        parent::__construct();

        $this->crudService = $crudService;
        $this->notificacaoService = $notificacaoService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventos:notificar-eventos-do-dia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventos = $this->crudService->getEventosHoje();

        foreach ($eventos as $evento) {
            $this->notificacaoService->enviarNotificacao($evento, TipoNotificacao::EVENTO_REAGENDADO);
        }

        $this->info('Notificações enviadas com sucesso!');
    }
}
