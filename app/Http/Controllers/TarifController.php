<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce; // N'oublie pas l'import

class TarifController extends Controller
{
    public function index(){
        return view('tarifs.index');
    }

    // On ajoute ->where('statut', 'disponible') partout

    public function showA() {
        $annonces = Annonce::where('type', 'Type 1')
                           ->where('statut', 'disponible') // Affiche seulement si dispo
                           ->get();
        return view('tarifs.offrea', compact('annonces'));
    }

    public function showB() {
        $annonces = Annonce::where('type', 'Type 2')
                           ->where('statut', 'disponible') // Affiche seulement si dispo
                           ->get();
        return view('tarifs.offreb', compact('annonces'));
    }

    public function showC() {
        $annonces = Annonce::where('type', 'Type 3')
                           ->where('statut', 'disponible') // Affiche seulement si dispo
                           ->get();
        return view('tarifs.offrec', compact('annonces'));
    }
}
