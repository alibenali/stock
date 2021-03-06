<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['produit_id', 'quantite', 'nbr_boites', 'prix_unite', 'prix_total', 'nom_acheteur', 'vendeur_id', 'statut', 'bon_id', 'verssement'];

    public function produits(){
        return $this->hasMany('App\Produit');
    }

    public function produit(){
        return $this->belongsTo('App\Produit', 'produit_id');
    }
}
