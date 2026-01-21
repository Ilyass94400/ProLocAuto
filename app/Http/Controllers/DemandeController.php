<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{

    public function showForm($id_annonce)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Connectez-vous pour réserver.');
        }

        $annonce = Annonce::findOrFail($id_annonce);

        return view('demandes.formulaire', compact('annonce'));
    }

    
    public function submitForm(Request $request, $id_annonce)
    {
        if (!Auth::check()) { return redirect()->route('login'); }

        $request->validate([
            'duree' => 'required',
            'date_debut' => 'required|date|after_or_equal:today',
        ]);

        $annonce = Annonce::findOrFail($id_annonce);
        $user = Auth::user();

        Demande::create([
            'user_id'       => $user->id,
            'nom_client'    => $user->name,
            'annonce_id'    => $annonce->id,
            'titre_annonce' => $annonce->titre,
            'duree'         => $request->input('duree'),
            'date_debut'    => $request->input('date_debut'),
            'message'       => $request->input('message'),
            'statut'        => 'En attente'
        ]);

        return redirect()->route('tarif')->with('success', 'Demande envoyée au commercial !');
    }
}