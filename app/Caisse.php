<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $table = 'caisse';
    protected $fillable = ['objectif', 'type', 'montant', 'responsable_id', 'caisse_avant', 'caisse_apres'];

}
