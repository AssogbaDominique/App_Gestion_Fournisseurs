<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom'];

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'categorie_fournisseur');
    }
    //use HasFactory;
}
