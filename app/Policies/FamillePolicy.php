<?php

namespace App\Policies;

use App\User;
use App\Famille;

use Illuminate\Auth\Access\HandlesAuthorization;

class FamillePolicy
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

    public function desactiver(User $user, Famille $famille)
    {
        return $famille->statut == 'activé';
    }

    public function activer(User $user, Famille $famille)
    {
        return $famille->statut == 'desactivé';
    }
}
