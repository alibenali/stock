<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $table = 'caisse';
    protected $fillable = ['famille_id','objectif', 'type', 'montant', 'responsable_id', 'caisse_avant', 'caisse_apres'];

    public function caisseFamille()
    {
        return $this->belongsTo('App\caisseFamille', 'famille_id');
    }

}
