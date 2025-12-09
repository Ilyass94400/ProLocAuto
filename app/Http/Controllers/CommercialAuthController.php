<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommercialAuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        // On pointe vers le nouveau nom de fichier : logincommercial.blade.php
        return view('commercial.logincommercial');
    }

    // Traite la soumission du formulaire
    public function login(Request $request)
    {
        // 1. Validation des données
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tentative de connexion via le guard 'commercial'
        // 'remember' permet de rester connecté (case "se souvenir de moi")
        if (Auth::guard('commercial')->attempt($credentials, $request->filled('remember'))) {
            
            // Régénérer la session pour la sécurité
            $request->session()->regenerate();

            // Redirection vers le tableau de bord commercial
            return redirect()->intended(route('commercial.dashboard'));
        }

        // 3. Echec de la connexion
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::guard('commercial')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('commercial.login');
    }

    // Le tableau de bord (Dashboard)
    public function dashboard()
    {
        return view('commercial.dashboard');
    }
}