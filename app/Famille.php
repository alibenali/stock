<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    protected $fillable = ['nom', 'statut'];

    public function produits()
    {
        return $this->hasMany('App\Produit');
    }
}
