<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nom_client', 
        'annonce_id', 'titre_annonce', 
        'duree', 'date_debut', 'message', 
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date', // Important pour gérer la date
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function annonce() { return $this->belongsTo(Annonce::class); }
}