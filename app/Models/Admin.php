<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// On ajoute cette ligne pour gérer l'authentification plus tard si besoin
use Illuminate\Foundation\Auth\User as Authenticatable; 

// Attention : On change 'extends Model' par 'extends Authenticatable'
// C'est une astuce pour que Laravel considère ce modèle comme un utilisateur connectable
class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'mail',
        'motdepasse',
    ];
}