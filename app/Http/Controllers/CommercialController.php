<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reservation;
use App\Models\Annonce; // IMPORTANT : On a besoin de manipuler les annonces
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    // --- AUTHENTIFICATION ---
    public function showLogin() { return view('commercial.logincommercial'); }
    public function authenticate(Request $request) {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);
        if (Auth::guard('commercial')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('commercial.dashboard');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }
    public function logout(Request $request) {
        Auth::guard('commercial')->logout();
        $request->session()->invalidate();
        return redirect()->route('commercial.login');
    }

    // --- DASHBOARD ---
    public function index() {
        $demandes = Demande::orderBy('created_at', 'desc')->get();
        return view('commercial.accueil', compact('demandes'));
    }

    // --- ACTIONS (C'est ici que ça change) ---

    public function valider($id) {
        $demande = Demande::findOrFail($id);
        
        // 1. Validation de la demande
        $demande->statut = 'Validée';
        $demande->save();

        try {
            // 2. Création de la réservation
            Reservation::create([
                'user_id'    => $demande->user_id,
                'annonce_id' => $demande->annonce_id,
                'date_debut' => $demande->date_debut,
                'duree'      => $demande->duree,
                'prix'       => $demande->annonce->prix ?? 0, 
                'statut'     => 'Confirmée'
            ]);

            // 3. VERROUILLAGE DE L'ANNONCE
            $annonce = Annonce::find($demande->annonce_id);
            if ($annonce) {
                $annonce->statut = 'reserve'; // On change le statut pour la cacher
                $annonce->save();
            }

        } catch (\Exception $e) {
            dd("Erreur : " . $e->getMessage());
        }

        return back()->with('success', 'Dossier validé et annonce retirée du site !');
    }

    public function refuser($id) {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'Refusée';
        $demande->save();
        return back()->with('warning', 'La demande a été refusée.');
    }
}