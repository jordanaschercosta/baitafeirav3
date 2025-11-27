<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class CadastroController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('cadastro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tipo' => 'required',
            'password' => 'required|string|min:6|confirmed', // espera campo password_confirmation
        ]);

        // Criar usuário
        $this->userService->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'tipo' => $request->tipo
        ]);

        // Redireciona ou retorna mensagem
        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function resetPassword(string $id)
    {
        return view('cadastro.reset_password', ['userId' => $id]);        
    }

    public function resetPasswordAction(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'id' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);

        try {
        
            $this->userService->changePassword($request->id, $request->password);

            return redirect()->route('login')->with('success', 'Senha atualizada com sucesso!');

        } catch (Throwable $throwable) {
            
            return view('cadastro.reset_password', ['userId' => $request->id])->with('error', $throwable->getMessage());
        }
    }
}
