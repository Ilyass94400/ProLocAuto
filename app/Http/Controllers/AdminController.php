<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;        // <--- C'est eux qu'on veut afficher !
use App\Models\Annonce;
use App\Models\Reservation;

class AdminController extends Controller
{
    // --- 1. CONNEXION ---
    public function showLogin() { return view('admin.login'); }

    public function authenticate(Request $request) {
        $request->validate(['mail' => 'required|email', 'motdepasse' => 'required']);
        $admin = Admin::where('mail', $request->mail)->first();

        if ($admin && Hash::check($request->motdepasse, $admin->motdepasse)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }
        return back()->withErrors(['mail' => 'Erreur login']);
    }

    // --- 2. ACCUEIL (MODIFIÉ) ---
    public function index() {
        // AVANT : $clients = Client::all();
        // MAINTENANT : On récupère les vrais utilisateurs inscrits
        $users = User::all();
        
        // On envoie la variable $users à la vue
        return view('admin.index', compact('users'));
    }

    // --- 3. GESTION ANNONCES ---
    public function manageAnnonces() {
        $annonces = Annonce::all();
        $annonceodia = null;
        return view('admin.annonce', compact('annonces', 'annonceodia'));
    }

    public function editAnnonceInManager($id) {
        $annonces = Annonce::all();
        $annonceodia = Annonce::findOrFail($id);
        return view('admin.annonce', compact('annonces', 'annonceodia'));
    }

    public function storeAnnonce(Request $request) {
        $request->validate(['titre'=>'required', 'prix'=>'required', 'type'=>'required', 'description'=>'required']);
        Annonce::create($request->all());
        return redirect()->route('admin.annonces.manage');
    }

    public function updateAnnonce(Request $request, $id) {
        $request->validate(['titre'=>'required', 'prix'=>'required', 'type'=>'required', 'description'=>'required']);
        Annonce::findOrFail($id)->update($request->all());
        return redirect()->route('admin.annonces.manage');
    }

    public function deleteAnnonce($id) {
        Annonce::findOrFail($id)->delete();
        return redirect()->route('admin.annonces.manage');
    }

    // --- 4. RÉSERVATION MANUELLE ---
    public function showManualReservationPage() {
        $users = User::all();
        $annonces = Annonce::all();
        return view('admin.reservation', compact('users', 'annonces'));
    }

    public function storeManualReservation(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'annonce_id' => 'required',
            'date_debut' => 'required|date'
        ]);
        Reservation::create([
            'user_id' => $request->user_id,
            'annonce_id' => $request->annonce_id,
            'date_debut' => $request->date_debut
        ]);
        return redirect()->route('admin.home')->with('success', 'Réservation validée !');
    }

    // --- 5. DÉCONNEXION ---
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}