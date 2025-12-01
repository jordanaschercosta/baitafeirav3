<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class UserService
{
    protected $emailService;
    
    public function getUserById($id)
    {
        return User::where("id", $id)->firstOrFail();
    }

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo' => $data['tipo'],
            'phone' => $data['phone']
        ]);
    }

    public function changePassword(int $id, string $password) 
    {
        $user = User::find($id);

        if ($user) {
            $user->password = Hash::make($password);
            $user->save();
        } else {
            throw new Exception("Usuário não encontrado.");
        }
    }
}