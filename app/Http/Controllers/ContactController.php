<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    // Affiche le formulaire de contact
    public function index()
    {
        // CORRECTION ICI : on pointe vers le dossier 'contact' et le fichier 'index'
        return view('contact.index');
    }

    // Traite l'envoi du message
    public function send(Request $request)
    {
        // 1. Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Enregistrement
        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'lu' => false,
        ]);

        // 3. Retour avec succès
        return back()->with('success', 'Votre message a bien été envoyé à notre équipe commerciale !');
    }
}