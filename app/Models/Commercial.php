<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// On importe le système d'authentification
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Commercial extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
    ];
}