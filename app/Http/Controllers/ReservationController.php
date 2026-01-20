<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // --- ACTIONS CLIENT ---

    // 1. MODIFIER LA RÉSERVATION
    public function update(Request $request, $id)
    {
        // On récupère la réservation du client connecté
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        // On empêche de modifier une réservation annulée
        if($reservation->statut === 'Annulée') {
            return back()->with('error', 'Cette réservation est annulée et ne peut plus être modifiée.');
        }

        // Validation des nouvelles données
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'duree' => 'required|string',
        ]);

        // Mise à jour
        $reservation->update([
            'date_debut' => $request->date_debut,
            'duree' => $request->duree,
        ]);

        return back()->with('success', 'Votre réservation a été modifiée avec succès.');
    }

    // 2. ANNULER LA RÉSERVATION
    public function annuler($id)
    {
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        if($reservation->statut === 'Annulée') {
            return back()->with('error', 'Cette réservation est déjà annulée.');
        }

        // On change le statut de la réservation
        $reservation->update(['statut' => 'Annulée']);

        // IMPORTANT : On libère l'annonce pour qu'elle redevienne "disponible" sur le site
        if($reservation->annonce) {
            $reservation->annonce->update(['statut' => 'disponible']);
        }

        return back()->with('success', 'Réservation annulée. L\'espace a été libéré.');
    }

    // --- (Garde tes anciennes fonctions store/create en dessous si tu en as besoin) ---
    public function create($id) { /* ... */ }
    public function store(Request $request) { /* ... */ }
}