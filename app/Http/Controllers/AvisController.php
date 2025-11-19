<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$avis = Avis::latest()->get(); 
        return view('avis.index', compact('avis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'auteur_nom' => 'required|max:255',
            'note' => 'required|integer|min:1|max:5', 
            'commentaire' => 'required|min:5',
        ]);

        Avis::create($request->all());

        return redirect()->route('avis.index')
                         ->with('success', 'Votre avis a été soumis avec succès!');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
