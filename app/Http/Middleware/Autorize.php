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
        if ($request->route()?->getActionMethod() === 'show') {
            return $next($request);
        }
    
        if (empty($this->authenticationService->getSession()[0])) {
            return redirect()->route('login')->with('error', 'Entre novamente');
        }

        return $next($request);
    }
}
