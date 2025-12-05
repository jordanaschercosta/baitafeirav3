<?php

namespace App\Services;

use App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail as TemplateEmail;
use Exception;
use Throwable;

class EmailService
{
    public function forgetPasswordEmail(Models\User $user)
    {
        $link = url('/resetar-senha/' . $user->id);

        try {
            Mail::to($user->email)->send(new TemplateEmail\EsqueciSenhaMail($user->name, $link));
        } catch (Exception $exception) {
            //
        }
    }

    public function cancelamentoEvento(Models\User $user, Models\Evento $evento)
    {
        try {
            Mail::to($user->email)->send(new TemplateEmail\CancelamentoEventoMail($user->name, $evento));
        } catch (Exception $exception) {
           //
        }
    }

    public function atualizacaoEvento(Models\User $user, Models\Evento $evento)
    {
        try {
            Mail::to($user->email)->send(new TemplateEmail\AtualizacaoEventoMail($user->name, $evento));
        } catch (Exception $exception) {
           //
        }
    }

    public function eventoLembrete(Models\User $user, Models\Evento $evento)
    {
        try {
            Mail::to($user->email)->send(new TemplateEmail\LembreteEventoMail($user->name, $evento));
        } catch (Exception $exception) {
            //
        }
    }
}