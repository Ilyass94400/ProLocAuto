<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Annonce; // J'ai ajouté l'import du modèle Annonce

class TarifController extends Controller
{
    public function index(){
        // J'ai corrigé l'erreur de syntaxe ici
        return view('tarifs.index');
    }

    // Fonction pour le Type 1
    public function showA() {
        $annonces = Annonce::where('type', 'Type 1')->get();
        return view('tarifs.offrea', compact('annonces'));
    }

    // Fonction pour le Type 2
    public function showB() {
        $annonces = Annonce::where('type', 'Type 2')->get();
        return view('tarifs.offreb', compact('annonces'));
    }

    // Fonction pour le Type 3
    public function showC() {
        $annonces = Annonce::where('type', 'Type 3')->get();
        return view('tarifs.offrec', compact('annonces'));
    }
}
