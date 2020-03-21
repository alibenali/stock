<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = ['produit_id', 'fournisseur_id' , 'quantite', 'prix_achat', 'statut'];
}
