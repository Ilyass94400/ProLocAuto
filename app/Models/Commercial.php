<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Changement important ici
use Illuminate\Notifications\Notifiable;

class Commercial extends Authenticatable
{
    use HasFactory, Notifiable;

    // On précise que ce modèle utilise le guard 'commercial'
    protected $guard = 'commercial';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
    ];

    // On cache le mot de passe pour qu'il n'apparaisse jamais dans les réponses JSON par erreur
    protected $hidden = [
        'password',
        'remember_token',
    ];
}