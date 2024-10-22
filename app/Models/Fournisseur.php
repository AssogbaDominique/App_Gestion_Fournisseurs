<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'status', 'archiver'];
    
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_fournisseur'); // Assure-toi que 'Category' est le bon nom
    }
}
