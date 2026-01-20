<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation;
use App\Models\Notification;
use App\Models\Message;

class AccountController extends Controller
{
    /**
     * Affiche la page "Mon Compte" (Liste des réservations)
     */
    public function index()
    {
        $client = Auth::user();
        
        // 1. On récupère les réservations
        $reservations = Reservation::where('user_id', $client->id)
                                   ->with('annonce')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // 2. AJOUT : On compte les notifications NON LUES
        $unreadCount = Notification::where('user_id', $client->id)
                                   ->where('lu', false)
                                   ->count();

        // 3. On envoie tout à la vue
        return view('clients.mon_compte', compact('client', 'reservations', 'unreadCount'));
    }

    /**
     * Affiche le "Tableau de Bord" (Infos personnelles)
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('clients.tableaudebord', compact('user'));
    }

    /**
     * Met à jour les informations du profil (Nom, Email, Mot de passe)
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->filled('current_password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Votre mot de passe a été modifié avec succès.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update(['name' => $request->name, 'email' => $request->email]);
        return back()->with('success', 'Vos informations ont été mises à jour.');
    }

    /**
     * Affiche la liste des notifications
     */
    public function notifications()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('clients.notification', compact('notifications'));
    }

    public function reply(Request $request)
    {
        $user = Auth::user();
        $request->validate(['sujet' => 'required', 'message' => 'required']);
        Message::create([
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'RE: ' . $request->sujet,
            'message' => "Réponse du client à la notification :\n\n" . $request->message,
            'lu' => false
        ]);
        return back()->with('success', 'Votre réponse a été envoyée au service commercial.');
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notification->update(['lu' => true]);
        return back()->with('success', 'Message marqué comme vu.');
    }
}