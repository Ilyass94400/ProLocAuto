<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// 1. On importe la classe qui gère l'authentification
use Illuminate\Foundation\Auth\User as Authenticatable;

// 2. IMPORTANT : On étend 'Authenticatable' et pas 'Model'
class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'mail',
        'motdepasse',
    ];

    // 3. On dit à Laravel : "Mon mot de passe est dans la colonne 'motdepasse'"
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }
}