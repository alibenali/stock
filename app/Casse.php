<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casse extends Model
{
    protected $fillable = ['produit_id', 'utilisateur_id', 'quantite', 'statut', 'observation'];


    public function users(){
        return $this->belongsTo('App\User', 'utilisateur_id');
    }
}
