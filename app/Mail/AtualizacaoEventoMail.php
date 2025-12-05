<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtualizacaoEventoMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome;
    public Evento $evento;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nome, Evento $evento)
    {
        $this->nome = $nome;
        $this->evento = $evento;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Atualização Dia/Local do Evento – ' . $this->evento->titulo)
            ->view('emails.atualizacao_evento')
            ->with([
                'nome'   => $this->nome,
                'evento' => $this->evento,
                // 'logo'   => $this->embed(
                //     public_path('images/logo.png')
                // )
            ]);
    }
}
