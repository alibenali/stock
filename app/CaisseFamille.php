<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaisseFamille extends Model
{
    public function caisse(){
        return $this->hasMany('App\Caisse');
    }
}
