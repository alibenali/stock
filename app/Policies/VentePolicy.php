<?php

namespace App\Policies;

use App\User;
use App\Vente;
use Illuminate\Auth\Access\HandlesAuthorization;

class VentePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function annuler(User $user, Vente $vente)
    {
        return $vente->statut !== 'Annulé' AND $vente->statut !== 'pre facturation';
    }

    public function valider(User $user, Vente $vente)
    {
        return $vente->statut == 'panier';
    }
}
