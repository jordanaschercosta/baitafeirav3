<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EsqueciSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome;
    public string $link;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nome, string $link)
    {
        $this->nome = $nome;
        $this->link = $link;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Recuperação de Senha')
            ->view('emails.esqueci_senha')
            ->with([
                'nome' => $this->nome,
                'link' => $this->link,
            ]);
    }
}
