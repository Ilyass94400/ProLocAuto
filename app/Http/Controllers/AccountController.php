<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation;
use App\Models\Notification; // <--- Import du nouveau modèle

class AccountController extends Controller
{
    // ... (Tes fonctions index, dashboard, updateProfile existent déjà) ...
    public function index() {
        $client = Auth::user();
        $reservations = Reservation::where('user_id', $client->id)->with('annonce')->orderBy('created_at', 'desc')->get();
        return view('clients.mon_compte', compact('client', 'reservations'));
    }
    public function dashboard() { $user = Auth::user(); return view('clients.tableaudebord', compact('user')); }
    public function updateProfile(Request $request) { /* ... ton code existant ... */ 
        $user = Auth::user();
        if ($request->filled('current_password')) {
            $request->validate(['current_password'=>'required|current_password','password'=>'required|min:8|confirmed']);
            $user->update(['password'=>Hash::make($request->password)]); return back()->with('success','Mot de passe changé.');
        }
        $request->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$user->id]);
        $user->update(['name'=>$request->name,'email'=>$request->email]); return back()->with('success','Profil mis à jour.');
    }

    // --- NOUVELLE FONCTION ---
    public function notifications()
    {
        $user = Auth::user();
        
        // On récupère les notifications de ce client
        $notifications = Notification::where('user_id', $user->id)
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        return view('clients.notification', compact('notifications'));
    }
}