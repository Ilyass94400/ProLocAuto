<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommercialController extends Controller
{
    public function index()
    {
        return view('commercial.devis'); 
    }
    public function store(Request $request)
    {   
        return redirect()->route('commercial.index')->with('success', 'Devis client enregistré !');
    }
}
