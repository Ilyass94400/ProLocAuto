<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pour savoir QUI est connecté
use App\Models\Annonce;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // 1. AFFICHER LA PAGE DE RÉSERVATION (GET)
    // On reçoit l'ID de l'annonce que le client veut réserver
    public function create($id)
    {
        // On récupère les infos de l'annonce (Prix, Titre...)
        $annonce = Annonce::findOrFail($id);
        
        // --- C'EST ICI LA CORRECTION ---
        // On appelle le fichier 'reservation.blade.php' dans le dossier 'reservations'
        return view('reservations.reservation', compact('annonce'));
    }

    // 2. ENREGISTRER LA RÉSERVATION (POST)
    public function store(Request $request)
    {
        // Validation : On vérifie qu'il y a une date et qu'elle est dans le futur
        $request->validate([
            'date_debut' => 'required|date|after:today',
            'annonce_id' => 'required|exists:annonces,id'
        ]);

        // Création de la réservation en base de données
        Reservation::create([
            'user_id' => Auth::id(), // L'ID du client connecté automatiquement
            'annonce_id' => $request->annonce_id,
            'date_debut' => $request->date_debut
        ]);

        // On redirige le client vers son espace perso avec un message de succès
        return redirect()->route('clients.accueil')->with('success', 'Bravo ! Votre réservation est validée.');
    }
}