<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticationService
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function saveSession(User $user)
    {
        session(['user_id' => $user->id]);
        session(['user.tipo' => $user->tipo]);
        session(['user_email' => $user->email]);
    }

    public function getSession()
    {
        return [
            session('user_id'), 
            session('user_email'),
            session('user.tipo')
        ];
    }

    public function authenticate(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return null;
        }

        if (Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function resetPasswordEmail(string $email): bool 
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return false;
        }

        $this->emailService->forgetPasswordEmail($user);

        return true;
    }

    public function destroy() 
    {
        session()->flush();
    }
}