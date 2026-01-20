<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reservation;
use App\Models\Annonce;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    // ... (Tes fonctions login, authenticate, logout, index, valider, refuser RESTENT IDENTIQUES) ...
    // Je ne remets que les nouvelles fonctions pour la messagerie

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
    public function index() {
        $demandes = Demande::orderBy('created_at', 'desc')->get();
        return view('commercial.accueil', compact('demandes'));
    }
    public function valider($id) {
        $d = Demande::findOrFail($id); $d->statut='Validée'; $d->save(); try { Reservation::create(['user_id'=>$d->user_id, 'annonce_id'=>$d->annonce_id, 'date_debut'=>$d->date_debut, 'duree'=>$d->duree, 'prix'=>$d->annonce->prix??0, 'statut'=>'Confirmée']); if($a=Annonce::find($d->annonce_id)){$a->statut='reserve';$a->save();} } catch(\Exception $e){} return back()->with('success','Validé');
    }
    public function refuser($id) {
        $d=Demande::findOrFail($id); $d->statut='Refusée'; $d->save(); return back()->with('warning','Refusée');
    }

    // --- MESSAGERIE ---

    public function messagerie()
    {
        // On affiche tous les messages
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('commercial.messagerie', compact('messages'));
    }

    // Fonction appelée en arrière-plan quand tu cliques sur un message
    public function marquerLu($id)
    {
        $message = Message::findOrFail($id);
        $message->lu = true;
        $message->save();

        return response()->json(['success' => true]);
    }
}