<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\Route;

class Autorize
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (strpos(request()->path(), "eventos") !== false) {
            if (! isUserOrganizador()) {
                if (request()->route()->getName() <> "eventos.index" && request()->route()->getName() <> "eventos.show") {
                    return redirect()->route('eventos.index')->with('error', 'Você não tem acesso ao recurso');
                }
            }
        } else {
            $redirectUrl = request()->query('redirect');
            if(!empty($redirectUrl)) {
                if (empty($this->authenticationService->getSession()[0])) {
                    return redirect()->route('login', ['redirect' => $redirectUrl])->with('error', 'Entre novamente');
                }
            } else {
                if (empty($this->authenticationService->getSession()[0])) {
                    return redirect()->route('login')->with('error', 'Entre novamente');
                }
            }
            // if(strpos($request->route()->getActionName(), "BancaController@show" == 0)) {
            // } else {
                // if (empty($this->authenticationService->getSession()[0])) {
                    // return redirect()->route('login')->with('error', 'Entre novamente');
                // }
            // }
        }

        return $next($request);
    }
}
