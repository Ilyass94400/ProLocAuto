<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Annonce; // <--- INDISPENSABLE

class AdminController extends Controller
{
    // --- 1. CONNEXION ---
    public function showLogin() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $request->validate(['mail' => 'required|email', 'motdepasse' => 'required']);
        $admin = Admin::where('mail', $request->mail)->first();

        if ($admin && Hash::check($request->motdepasse, $admin->motdepasse)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }
        return back()->withErrors(['mail' => 'Email ou mot de passe incorrect.']);
    }

    // --- 2. TABLEAU DE BORD ---
    public function index() {
        $clients = Client::all();
        $annonces = Annonce::all();
        return view('admin.index', compact('clients', 'annonces'));
    }

    // --- 3. GESTION DES ANNONCES (C'EST ÇA QU'IL TE MANQUAIT !) ---

    // Affiche le formulaire (La fonction que Laravel ne trouvait pas)
    public function createAnnonce() {
        return view('admin.annonce'); // On va créer ce fichier juste après
    }

    // Enregistre l'annonce
    public function storeAnnonce(Request $request) {
        $request->validate([
            'titre' => 'required',
            'prix' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);

        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'type' => $request->type
        ]);

        return redirect()->route('admin.home');
    }

    public function deleteAnnonce($id) {
        Annonce::findOrFail($id)->delete();
        return redirect()->route('admin.home');
    }

    // --- 4. DECONNEXION ---
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}