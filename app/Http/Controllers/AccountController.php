<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation;

class AccountController extends Controller
{
    // Affiche la page "Mon Compte" (existante)
    public function index()
    {
        $client = Auth::user();
        $reservations = Reservation::where('user_id', $client->id)
                                   ->with('annonce')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('clients.mon_compte', compact('client', 'reservations'));
    }

    // Affiche le Tableau de Bord Perso (NOUVELLE PAGE)
    public function dashboard()
    {
        // On récupère les infos de l'utilisateur connecté depuis la BD
        $user = Auth::user();
        
        return view('clients.tableaudebord', compact('user'));
    }

    // Traite la mise à jour des infos
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // 1. Mise à jour du MOT DE PASSE
        if ($request->filled('current_password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed', // 'confirmed' cherche un champ password_confirmation
            ]);

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('success', 'Votre mot de passe a été modifié avec succès.');
        }

        // 2. Mise à jour des infos GÉNÉRALES (Nom / Email)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Vos informations ont été mises à jour.');
    }
}