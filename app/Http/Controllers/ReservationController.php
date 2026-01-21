<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{


    
    public function update(Request $request, $id)
    {
        
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        
        if($reservation->statut === 'Annulée') {
            return back()->with('error', 'Cette réservation est annulée et ne peut plus être modifiée.');
        }

        
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'duree' => 'required|string',
        ]);

        
        $reservation->update([
            'date_debut' => $request->date_debut,
            'duree' => $request->duree,
        ]);

        return back()->with('success', 'Votre réservation a été modifiée avec succès.');
    }

    
    public function annuler($id)
    {
        $reservation = Reservation::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();

        if($reservation->statut === 'Annulée') {
            return back()->with('error', 'Cette réservation est déjà annulée.');
        }

        
        $reservation->update(['statut' => 'Annulée']);

    
        if($reservation->annonce) {
            $reservation->annonce->update(['statut' => 'disponible']);
        }

        return back()->with('success', 'Réservation annulée. L\'espace a été libéré.');
    }


    public function create($id) { /* ... */ }
    public function store(Request $request) { /* ... */ }
}