<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class SecretController extends Controller
{
    
    public function showForm()
    {
        return view('secret.create');
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'mail' => 'required|email|unique:admins,mail', 
            'motdepasse' => 'required|min:6'
        ]);

        
        Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'mail' => $request->mail,
        
            'motdepasse' => Hash::make($request->motdepasse),
        ]);

        return back()->with('success', 'Administrateur créé avec succès ! Vous pouvez fermer cette page.');
    }
}