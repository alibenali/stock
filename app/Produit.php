<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'fournisseur_id', 'famille_id', 'designation' , 'quantite', 'colis', 'nbr_colis', 'prix_achat'
    ];


    public function familles()
    {
        return $this->belongsTo('App\Famille', 'famille_id');
    }

    public function fournisseurs()
    {
        return $this->belongsTo('App\Fournisseur', 'fournisseur_id');
    }
}
