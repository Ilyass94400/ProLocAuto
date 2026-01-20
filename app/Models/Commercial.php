<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Changement important ici
use Illuminate\Notifications\Notifiable;

class Commercial extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $guard = 'commercial';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}