<?php

namespace App\Models;

use App\Models\region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ville extends Model
{
    use HasFactory;
    protected $fillable = [
        'Ville',
        'region_id'
    ];
    public function regions()
    {
        return $this->BelongsTo(region::class);
    }
    public function offres()
    {
        return $this->hasMany(offre::class);
    }
}
