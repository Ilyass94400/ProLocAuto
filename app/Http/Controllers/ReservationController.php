<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class ReservationController extends Controller
{
    
    public function update(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        
        if($reservation->statut === 'Annulée') {
            return back()->with('error', 'Cette réservation est annulée.');
        }

        
        if (Carbon::now()->addDays(3)->gt($reservation->date_debut)) {
            return back()->with('error', 'Impossible de modifier : le début de la réservation est dans moins de 3 jours.');
        }

        $request->validate([
            'message_modif' => 'required|string|min:10',
        ]);

        // 3. Envoi du message et changement de statut
        Message::create([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'subject' => 'Demande de modification - Réservation #' . $reservation->id,
            'message' => "Le client souhaite modifier sa réservation pour l'espace : " . $reservation->annonce->titre . ".\n\nDétails de la demande :\n" . $request->message_modif,
            'lu' => false
        ]);

        $reservation->update([
            'statut' => 'En attente de modification'
        ]);

        return back()->with('success', 'Votre demande a été envoyée. Le statut de votre réservation a été mis à jour.');
    }

    // --- ANNULER ---
    public function annuler($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if($reservation->statut === 'Annulée') return back()->with('error', 'Déjà annulée.');

        
        if (Carbon::now()->addDays(3)->gt($reservation->date_debut)) {
            return back()->with('error', 'Annulation impossible : le préavis de 3 jours est dépassé.');
        }

        $reservation->update(['statut' => 'Annulée']);
        
        if($reservation->annonce) {
            $reservation->annonce->update(['statut' => 'disponible']);
        }

        return back()->with('success', 'Réservation annulée.');
    }
    
    // Fonctions legacy
    public function create($id) {}
    public function store(Request $request) {}
}