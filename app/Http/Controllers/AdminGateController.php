<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminGateController extends Controller
{
    
    public function showForm()
    {
        return view('admin.gate');
    }


    public function verify(Request $request)
    {
        
        $codeSecret = "azerty"; 

        if ($request->code === $codeSecret) {
            
            $request->session()->put('admin_unlocked', true);
            
            
            return redirect()->route('admin.login');
        }

        
        return back()->with('error', 'Accès refusé. Code incorrect.');
    }
}