<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['produit_id', 'quantite', 'nbr_boites', 'prix_unite', 'prix_total', 'nom_acheteur', 'vendeur_id', 'statut'];

    public function produits(){
        return $this->hasMany('App\Produit');
    }
}
