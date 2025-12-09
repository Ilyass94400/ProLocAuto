<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // 1. Autorisation des champs (correspond à ta migration)
    protected $fillable = [
        'user_id',
        'annonce_id',
        'date_debut',
    ];

    // 2. Les Relations (Pour naviguer entre les tables)

    // Permet de faire : $reservation->user->name
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Permet de faire : $reservation->annonce->titre
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}