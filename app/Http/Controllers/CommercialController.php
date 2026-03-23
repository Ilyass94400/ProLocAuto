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


    public function showLogin() {
        return view('commercial.logincommercial');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::guard('commercial')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('commercial.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request) {
        Auth::guard('commercial')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('commercial.login');
    }



    public function index() {
    
        $demandes = Demande::orderBy('created_at', 'desc')->get();
        
        
        $reservations = Reservation::with(['user', 'annonce'])->orderBy('created_at', 'desc')->get();
        

        $modifications = Reservation::where('statut', 'En attente de modification')->get();

        
        $unreadMessages = Message::where('lu', false)->count();

        return view('commercial.accueil', compact('demandes', 'reservations', 'modifications', 'unreadMessages'));
    }


    public function valider($id) {
        $demande = Demande::findOrFail($id);
        
        $demande->statut = 'Validée';
        $demande->save();

        try {
            Reservation::create([
                'user_id'    => $demande->user_id,
                'annonce_id' => $demande->annonce_id,
                'date_debut' => $demande->date_debut,
                'duree'      => $demande->duree,
                'prix'       => $demande->annonce->prix ?? 0,
                'statut'     => 'Confirmée'
            ]);

            $annonce = Annonce::find($demande->annonce_id);
            if ($annonce) {
                $annonce->statut = 'reserve';
                $annonce->save();
            }
        } catch (\Exception $e) {
            
        }

        return back()->with('success', 'Dossier validé et réservation créée.');
    }

    public function refuser($id) {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'Refusée';
        $demande->save();
        return back()->with('warning', 'La demande a été refusée.');
    }

 

    public function messagerie() {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('commercial.messagerie', compact('messages'));
    }

    public function marquerLu($id) {
        $message = Message::findOrFail($id);
        $message->lu = true;
        $message->save();
        return response()->json(['success' => true]);
    }

    public function replyToMessage(Request $request, $id) {
        $original = Message::findOrFail($id);
        $client = User::where('email', $original->email)->first();

        if (!$client) {
            return back()->with('error', 'Impossible de répondre : aucun compte client trouvé pour cet email.');
        }

        Notification::create([
            'user_id' => $client->id,
            'sujet'   => 'RE: ' . $original->subject,
            'message' => $request->response_message,
            'lu'      => false
        ]);

        return back()->with('success', 'Réponse envoyée sur l\'espace client.');
    }

    public function pageEnvoyerMessage() {
        $clients = User::orderBy('name')->get();
        return view('commercial.envoyermessage', compact('clients'));
    }

    public function envoyerMessage(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'sujet'   => 'required',
            'message' => 'required'
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'sujet'   => $request->sujet,
            'message' => $request->message,
            'lu'      => false
        ]);

        return redirect()->route('commercial.messagerie')->with('success', 'Message envoyé au client avec succès.');
    }

    

    public function accepterModification($id) {
        
        return redirect()->route('commercial.reservations.edit', $id);
    }

    public function refuserModification($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'Modification refusée';
        $reservation->save();

        Notification::create([
            'user_id' => $reservation->user_id,
            'sujet'   => 'Modification refusée',
            'message' => "Votre demande de modification pour la réservation #{$reservation->id} a été refusée. Les dates initiales restent inchangées.",
            'lu'      => false
        ]);

        return back()->with('warning', 'La demande de modification a été refusée.');
    }

    

    public function listeReservations() {
        return redirect()->route('commercial.dashboard');
    }

    public function editReservation($id) {
        $reservation = Reservation::findOrFail($id);
        
        $messageClient = Message::where('subject', 'like', '%Réservation #' . $id . '%')
                                ->orderBy('created_at', 'desc')
                                ->first();
                                
        return view('commercial.edit_reservation', compact('reservation', 'messageClient'));
    }

    public function updateReservation(Request $request, $id) {
        $reservation = Reservation::findOrFail($id);
        
        $request->validate([
            'date_debut' => 'required|date',
            'duree'      => 'required|string',
            'prix'       => 'required|numeric',
            'statut'     => 'required|string',
        ]);

        $reservation->update([
            'date_debut' => $request->date_debut,
            'duree'      => $request->duree,
            'prix'       => $request->prix,
            'statut'     => $request->statut,
        ]);


        if($request->statut == 'Confirmée') {
             Notification::create([
                'user_id' => $reservation->user_id,
                'sujet'   => 'Mise à jour validée',
                'message' => "Modification finalisée avec succès.",
                'lu'      => false
            ]);
        }

        return redirect()->route('commercial.dashboard')->with('success', 'Réservation modifiée.');
    }
}