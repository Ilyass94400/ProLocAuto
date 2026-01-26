<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminGate
{
    public function handle(Request $request, Closure $next): Response
    {
        // On vérifie si la session contient la "clé" d'accès
        if ($request->session()->get('admin_unlocked') !== true) {
            // Si non, on redirige vers la page pour entrer le code
            return redirect()->route('admin.gate.form');
        }

        return $next($request);
    }
}