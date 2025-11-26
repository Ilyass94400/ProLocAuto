<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\avis;

class AvisController extends Controller
{
    public function index()
    {
        $avis = Avis::latest()->get(); 
        $noteMoyenne = $avis->avg('note');

        return view('avis.index', compact('avis', 'noteMoyenne'));
    }
    public function store(Request $request)
    {
        try {
            Avis::create([
                'auteur_nom' => $request->input('name', 'Client Anonyme'),
                'note' => $request->input('rating', 5),
                'commentaire' => $request->input('comment', 'Commentaire non fourni.'), 
            ]);
        } catch (\Exception $e) {
             return back()->withErrors(['db_error' => 'Erreur lors de l\'enregistrement de l\'avis.']);
        }
        return redirect()->route('avis.index')->with('success', 'Votre avis a été soumis avec succès !');
    }
}