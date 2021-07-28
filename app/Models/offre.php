<?php

namespace App\Models;

use App\Models\User;
use App\Models\ville;
use App\Models\region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class offre extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'secteur_id',
        'diplome_id',
        "Niveau d'experience",
        'etat',
        'typeoffre_id',
        'ville_id',
    ];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function villes()
    {
        return $this->BelongsTo(ville::class);
    }
    public function regions()
    {
        return $this->BelongsTo(region::class);
    }
    
}
