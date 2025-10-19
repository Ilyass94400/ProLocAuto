<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAreaController extends Controller
{
    public function index()
    {
        $client = Auth::user(); 
        return view('clients.accueil', compact('client'));
    }
}
