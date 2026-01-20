<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'mail',
        'motdepasse',
    ];

    
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }
}