<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
        'nom_complet', 'contacte'
    ];


    public function produits(){
        return $this->hasMany('App\Produit', 'fournisseur_id');
    }
}
