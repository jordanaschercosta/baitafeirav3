<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthenticationService;
use App\Models\User;

class SessaoController extends Controller
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('sessao.login');
    }

    /**
     * Display a listing of the resource.
     */
    public function salvaLocalizacao(Request $request)
    {
        $data = $request->json()->all();

        session([
            'user_lat' => $data['latitude'],
            'user_lng' => $data['longitude'],
        ]);

        return response()->json(['status' => 'Localização salva com sucesso!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function authenticate(Request $request)
    {
        $autentica = $this->authenticationService->authenticate($request->email, $request->password); 

        if ($autentica) {
            $this->authenticationService->saveSession($autentica);

            if (!empty(request()->query('redirect'))) {
                return redirect(request()->query('redirect'));
            }

            return redirect()->route('eventos.index');
        }

        return redirect()->back()->with('error', 'Usuário ou senha incorretos.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function forgetPassword()
    {
        return view('sessao.forget_password');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function forgetPasswordAction(Request $request)
    {
        $usuario = $this->authenticationService->resetPasswordEmail($request->email); 

        if ($usuario) {
            return redirect()->back()->with('success', 'Verifique seu email!');
        }

        return redirect()->back()->with('error', 'Usuário não encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $this->authenticationService->destroy();

        return redirect()->route('home')->with('success', 'Sessão encerrada com sucesso!');
    }
}
