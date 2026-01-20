<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reservation;
use App\Models\Annonce;
use App\Models\Message;
use App\Models\User;         // Pour la liste des clients
use App\Models\Notification; // Pour sauvegarder l'envoi
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    // ... (Tes fonctions existantes : login, index, valider, refuser, messagerie, marquerLu) ...
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

    // --- NOUVELLES FONCTIONS POUR L'ENVOI ---

    // 1. Afficher la page "envoyermessage.blade.php"
    public function pageEnvoyerMessage()
    {
        // On a besoin de la liste des clients pour le menu déroulant
        $clients = User::orderBy('name')->get();
        return view('commercial.envoyermessage', compact('clients'));
    }

    // 2. Traiter l'envoi du formulaire
    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Création de la notification pour le client
        Notification::create([
            'user_id' => $request->user_id,
            'sujet' => $request->sujet,
            'message' => $request->message,
            'lu' => false
        ]);

        return redirect()->route('commercial.messagerie')->with('success', 'Message envoyé au client avec succès !');
    }
}