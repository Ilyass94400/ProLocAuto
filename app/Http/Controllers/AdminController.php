<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\Commercial;

class AdminController extends Controller
{
    // --- 1. CONNEXION ---
    public function showLogin() {
        return view('admin.login');
    }

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

    // --- 2. ACCUEIL ---
    public function index() {
        $users = User::all();
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

    // --- 5. GESTION DES COMMERCIAUX ---
    public function createCommercial()
    {
        $commercials = Commercial::all();
        return view('admin.commercial.create', compact('commercials'));
    }

    public function storeCommercial(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:commercials,email',
            'password' => 'required|min:4'
        ]);

        Commercial::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.commercial.create')->with('success', 'Commercial créé avec succès !');
    }

    // --- 6. DÉCONNEXION ---
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}