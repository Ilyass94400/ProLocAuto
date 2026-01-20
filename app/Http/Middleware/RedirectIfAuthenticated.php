<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                // C'est ici que ça se passe :
                // Si c'est un COMMERCIAL connecté -> On l'envoie vers SON tableau de bord
                if ($guard === 'commercial') {
                    return redirect()->route('commercial.dashboard');
                }

                // Pour tous les autres (Admin ou Client) -> On les envoie vers l'accueil du site
                return redirect('/');
            }
        }

        return $next($request);
    }
}