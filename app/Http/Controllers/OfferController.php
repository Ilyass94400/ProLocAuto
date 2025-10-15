<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(){
		$offers = [];
		return view('offers.index', compact('offers'));
	}
}

?>
