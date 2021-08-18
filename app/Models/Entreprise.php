<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'societe',
        'Raison sociale',
        'secteur_id',
        'telephone',
        'fax',
        'ville_id',
        'adresse'
    ];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function offre()
    {
        return $this->hasMany(offre::class);
    }
}
