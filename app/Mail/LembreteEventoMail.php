<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LembreteEventoMail extends Mailable
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
            ->subject('Lembrete de Evento – ' . $this->evento->titulo)
            ->view('emails.lembrete_evento')
            ->with([
                'nome'   => $this->nome,
                'evento' => $this->evento,
            ]);
    }
}
