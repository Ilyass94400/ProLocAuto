<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avis extends Model
{
    use HasFactory;
    protected $fillable = [
        'auteur_nom',
        'note',
        'commentaire',
    ];
    
    public function espace()
    {
        return $this->belongsTo(Espace::class);
}
}
