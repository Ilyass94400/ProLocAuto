<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function index(){
		return view('contact.index');
	}
	public function send(Request $request){
		$request->validate([
		'name' => 'required',
		'email' => 'required | email',
		'subject' => 'required',
		'message' => 'required'
		]);
		
		return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous recontacterons bientôt.');
		}
}
