<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce; 

class TarifController extends Controller
{
    public function index(){
        return view('tarifs.index');
    }

    

    public function showA() {
        $annonces = Annonce::where('type', 'Type 1')
                           ->where('statut', 'disponible') 
                           ->get();
        return view('tarifs.offrea', compact('annonces'));
    }

    public function showB() {
        $annonces = Annonce::where('type', 'Type 2')
                           ->where('statut', 'disponible') 
                           ->get();
        return view('tarifs.offreb', compact('annonces'));
    }

    public function showC() {
        $annonces = Annonce::where('type', 'Type 3')
                           ->where('statut', 'disponible') 
                           ->get();
        return view('tarifs.offrec', compact('annonces'));
    }
}
