<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
private $fakeReviews = [
        [
            'name' => 'Alice',
            'rating' => 5,
            'comment' => 'Super espace de coworking, ambiance au top !',
            'created_at' => '2025-10-10 14:30:00'
        ],
        [
            'name' => 'Karim',
            'rating' => 4,
            'comment' => 'Très bon accueil et équipements modernes.',
            'created_at' => '2025-10-12 09:45:00'
        ],
    ];

    public function index()
    {
     
        $reviews = $this->fakeReviews;
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

       
        return redirect()->back()->with('success', 'Merci pour votre avis (simulation) !');
    }
}
?>
