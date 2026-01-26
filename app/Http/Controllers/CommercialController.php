<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reservation;
use App\Models\Annonce;
use App\Models\Message;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    
    public function showLogin() { return view('commercial.logincommercial'); }
    public function authenticate(Request $request) { /*...*/ if(Auth::guard('commercial')->attempt($credentials)){$request->session()->regenerate();return redirect()->route('commercial.dashboard');}return back()->withErrors(['email'=>'Erreur']); }
    public function logout(Request $request) { Auth::guard('commercial')->logout();$request->session()->invalidate();return redirect()->route('commercial.login'); }
    public function index() { $demandes = Demande::orderBy('created_at', 'desc')->get(); $reservations = Reservation::with(['user', 'annonce'])->orderBy('created_at', 'desc')->get(); return view('commercial.accueil', compact('demandes', 'reservations')); }
    public function valider($id) { /*...*/ return back()->with('success','Validé'); }
    public function refuser($id) { /*...*/ return back()->with('warning','Refusée'); }
    public function messagerie() { $messages = Message::orderBy('created_at', 'desc')->get(); return view('commercial.messagerie', compact('messages')); }
    public function marquerLu($id) { /*...*/ return response()->json(['success'=>true]); }
    public function replyToMessage(Request $request, $id) { /*...*/ return back()->with('success', 'Réponse envoyée.'); }
    public function pageEnvoyerMessage() { $clients = User::orderBy('name')->get(); return view('commercial.envoyermessage', compact('clients')); }
    public function envoyerMessage(Request $request) { /*...*/ return redirect()->route('commercial.messagerie')->with('success','Envoyé'); }
    public function listeReservations() { return redirect()->route('commercial.dashboard'); }
    public function accepterModification($id) { return back(); }

  

    
    public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        

        $messageClient = Message::where('subject', 'like', '%Réservation #' . $id . '%')
                                ->orderBy('created_at', 'desc')
                                ->first();

        return view('commercial.edit_reservation', compact('reservation', 'messageClient'));
    }

    
    public function refuserModification($id)
    {
        $reservation = Reservation::findOrFail($id);
        

        $reservation->statut = 'Modification refusée';
        $reservation->save();

        
        Notification::create([
            'user_id' => $reservation->user_id,
            'sujet' => 'Demande refusée',
            'message' => "Votre demande de modification pour la réservation #{$reservation->id} a été refusée. Les dates initiales sont maintenues.",
            'lu' => false
        ]);

        return redirect()->route('commercial.dashboard')->with('warning', 'La demande de modification a été refusée.');
    }

    
    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $request->validate([
            'date_debut' => 'required|date',
            'duree' => 'required|string',
            'prix' => 'required|numeric',
            'statut' => 'required|string',
        ]);

        $reservation->update([
            'date_debut' => $request->date_debut,
            'duree' => $request->duree,
            'prix' => $request->prix,
            'statut' => $request->statut,
        ]);

        
        Notification::create([
            'user_id' => $reservation->user_id,
            'sujet' => 'Modification validée',
            'message' => "Votre réservation a été modifiée avec succès selon votre demande.",
            'lu' => false
        ]);

        return redirect()->route('commercial.dashboard')->with('success', 'Modification enregistrée et validée.');
    }
}