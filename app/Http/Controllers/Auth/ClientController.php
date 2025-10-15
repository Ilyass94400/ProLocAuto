<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function showLoginForm()
    {
		return view('auth.client-login');
	}
	
	public function login(Request $request){
		$credentials = $request->only('email', 'password');
		
		if(Auth::attempt($credentials)){
			return redirect()->intended('/deshboard');
		}
		
		return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
	}
	
	public function logout(){
		Auth::logout();
		return redirect('/login');
	}
    
}
