<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
		$client = Auth::user();
		return view('clients.mon_compte', ['client' => $client,]);
	}
}
