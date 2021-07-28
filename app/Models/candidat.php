<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class candidat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'civilite',
        'nom',
        'prenom',
        'dn',
        'telephone',
        'telephoned',
        'adresse',
        'region_id',
        'ville_id',
        'diplome_id',
        'secteur_id',
        'metier_id',
        'filecv',
    ];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
