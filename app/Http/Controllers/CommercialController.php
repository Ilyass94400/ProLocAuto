<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reservation;
use App\Models\Annonce;
use App\Models\Message;
use App\Models\User;         // Pour retrouver le client
use App\Models\Notification; // Pour créer la réponse
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    // ... Tes fonctions existantes (login, index, etc.) ...
    public function showLogin() { return view('commercial.logincommercial'); }
    public function authenticate(Request $request) {
        $credentials = $request->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::guard('commercial')->attempt($credentials)){$request->session()->regenerate();return redirect()->route('commercial.dashboard');}
        return back()->withErrors(['email'=>'Erreur']);
    }
    public function logout(Request $request) { Auth::guard('commercial')->logout();$request->session()->invalidate();return redirect()->route('commercial.login'); }
    public function index() { $demandes = Demande::orderBy('created_at','desc')->get(); return view('commercial.accueil', compact('demandes')); }
    public function valider($id) { $d=Demande::findOrFail($id); $d->statut='Validée'; $d->save(); try{Reservation::create(['user_id'=>$d->user_id,'annonce_id'=>$d->annonce_id,'date_debut'=>$d->date_debut,'duree'=>$d->duree,'prix'=>$d->annonce->prix??0,'statut'=>'Confirmée']); if($a=Annonce::find($d->annonce_id)){$a->statut='reserve';$a->save();}}catch(\Exception $e){} return back()->with('success','Validé'); }
    public function refuser($id) { $d=Demande::findOrFail($id); $d->statut='Refusée'; $d->save(); return back()->with('warning','Refusée'); }
    public function messagerie() { $messages = Message::orderBy('created_at', 'desc')->get(); return view('commercial.messagerie', compact('messages')); }
    public function marquerLu($id) { $m=Message::findOrFail($id); $m->lu=true; $m->save(); return response()->json(['success'=>true]); }
    public function pageEnvoyerMessage() { $clients = User::orderBy('name')->get(); return view('commercial.envoyermessage', compact('clients')); }
    public function envoyerMessage(Request $request) {
        $request->validate(['user_id' => 'required|exists:users,id', 'sujet' => 'required', 'message' => 'required']);
        Notification::create(['user_id' => $request->user_id, 'sujet' => $request->sujet, 'message' => $request->message]);
        return redirect()->route('commercial.messagerie')->with('success', 'Message envoyé !');
    }

    // --- NOUVELLE FONCTION : RÉPONDRE À UN MESSAGE REÇU ---
    public function replyToMessage(Request $request, $id)
    {
        // 1. Récupérer le message d'origine
        $originalMessage = Message::findOrFail($id);

        // 2. Chercher si un client possède cet email
        $client = User::where('email', $originalMessage->email)->first();

        // 3. Validation
        $request->validate(['response_message' => 'required|string']);

        if (!$client) {
            return back()->with('error', 'Impossible de répondre en interne : cet email ne correspond à aucun compte client. Utilisez votre boite mail classique.');
        }

        // 4. Créer la notification (la réponse) pour le client
        Notification::create([
            'user_id' => $client->id,
            'sujet'   => 'RE: ' . $originalMessage->subject,
            'message' => $request->response_message,
            'lu'      => false
        ]);

        return back()->with('success', 'Réponse envoyée directement sur l\'espace client de ' . $client->name);
    }
}