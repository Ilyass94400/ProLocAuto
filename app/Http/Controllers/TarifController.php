<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

class TarifController extends Controller
{
    public function index(){
		Admin::all();
		return view('tarifs.index, $test');
	}
}
