<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\avis; // Assurez-vous que l'orthographe est correcte

class AvisController extends Controller
{
    /**
     * Affiche la liste des avis et le formulaire.
     */
    public function index()
    {
        // Récupère tous les avis, triés par les plus récents
        $avis = Avis::latest()->get(); 
        
        // Calcul de la note moyenne pour l'affichage
        $noteMoyenne = $avis->avg('note');

        return view('avis.index', compact('avis', 'noteMoyenne'));
    }

    /**
     * Gère la soumission d'un nouvel avis, SANS VALIDATION.
     */
    public function store(Request $request)
    {
        // ATTENTION : Aucune validation des données (required, min, max, etc.)
        
        try {
            Avis::create([
                // Utilise le champ 'name' pour l'auteur (doit correspondre au formulaire)
                'auteur_nom' => $request->input('name', 'Client Anonyme'),
                'note' => $request->input('rating', 5), // Assurez-vous que le nom du champ est 'rating'
                'commentaire' => $request->input('comment', 'Commentaire non fourni.'), // Assurez-vous que le nom du champ est 'comment'
            ]);
        } catch (\Exception $e) {
             // Afficher l'erreur de la base de données
             return back()->withErrors(['db_error' => 'Erreur lors de l\'enregistrement de l\'avis.']);
        }

        // Redirection vers la page d'index avec un message de succès
        return redirect()->route('avis.index')->with('success', 'Votre avis a été soumis avec succès !');
    }
}