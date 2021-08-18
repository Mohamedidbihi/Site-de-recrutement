<?php

namespace App\Models;

use App\Models\ville;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class region extends Model
{

    use HasFactory;
    protected $fillable = [
        'region',
    ];
    public function villes()
    {
        return $this->hasMany(ville::class);
    }
    
}
