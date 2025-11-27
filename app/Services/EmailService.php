<?php

namespace App\Services;

use App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EsqueciSenhaMail;
use Throwable;

class EmailService
{
    public function forgetPasswordEmail(Models\User $user)
    {
        $link = url('/resetar-senha/' . $user->id);

        try {
            Mail::to($user->email)->send(new EsqueciSenhaMail($user->name, $link));
        } catch (Throwable $throwable) {
            //
        }
    }
}