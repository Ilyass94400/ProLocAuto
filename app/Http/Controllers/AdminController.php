<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Client;

class AdminController extends Controller
{
    // Affiche le formulaire
    public function showLogin()
    {
        return view('admin.login');
    }

    // Traite la connexion
    public function authenticate(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'motdepasse' => 'required'
        ]);

        $admin = Admin::where('mail', $request->mail)->first();

        if ($admin && Hash::check($request->motdepasse, $admin->motdepasse)) {
            
            // --- C'EST ICI QUE ÇA CHANGE ---
            // On précise qu'on utilise le guard 'admin'
            Auth::guard('admin')->login($admin);
            // -------------------------------
            
            $request->session()->regenerate();

            return redirect()->route('admin.home');
        }

        return back()->withErrors([
            'mail' => 'Email ou mot de passe incorrect.',
        ]);
    }

    // Affiche le tableau de bord
    public function index()
    {
        $clients = Client::all();
        return view('admin.index', compact('clients'));
    }

    // Déconnexion
    public function logout(Request $request)
    {
        // --- ICI AUSSI ON CHANGE ---
        Auth::guard('admin')->logout();
        // ---------------------------
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}